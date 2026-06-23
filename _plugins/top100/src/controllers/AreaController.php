<?php
/**
 * top100 plugin for Craft CMS 3.x
 *
 * top100 plugin
 *
 * @link      https://www.verse.co.uk/
 * @copyright Copyright (c) 2021 Verse
 * @copyright Copyright (c) 2021 Verse
 */

namespace verse\top100\controllers;

use Craft;
use craft\elements\Asset;
use craft\elements\Category;
use craft\elements\Entry;
use craft\web\Controller;

/**
 * Area Controller
 *
 */
class AreaController extends Controller
{
    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['index'];

    /**
     * actionIndex
     *  Build data required for the attractions search page
     *  This was created to improve site performance by processing data as much as possible by
     *  assigning slim data to the template and reducing queries
     *
     * @param string $area
     * @return \yii\web\Response
     */
    public function actionIndex($area = '')
    {
        // Get request
        $request = Craft::$app->getRequest();

        // Get query params
        $params = $request->getQueryParams();

        // Define default params
        if (!isset($params['area']))
            $params['area'] = $area;

        if (!isset($params['map']))
            $params['map'] = false;

        if (!isset($params['types']))
            $params['types'] = '';

        // Get search terms
        $area = $params['area'] ?: 'Great Britain';

        // Get if we are using the map view
        $usingMapView = (bool)$params['map'];

        // Set cookie as we are using map view
        if ($usingMapView) {
            setcookie('showAttractionsMap', 1, 2147483647, "/");
        }

        // Cookie is dropped in web/assets/JS/_components/attractions.js to store if map view is selected
        if(isset($_COOKIE['showAttractionsMap']) && $_COOKIE['showAttractionsMap']) {
            // if it is selected then persist as the user navigates the site
            $usingMapView = true;
        }

        // Get all types from attractions filter or get all
        $types = $params['types'] ? explode(',',$params['types']) : Category::find()->group('attractionType')->ids();

        // Define attraction data
        $attractionData = [];

        // Define query results
        $results = [];

        // Get attractions filter
        //  or use all attractions
        // Get the area from the search terms
        $areaResults = Entry::find()
            ->section('areas')
            ->search('title::"'. $area. '" OR slug::"'. $area.'"')
            ->one();

        // Adding check so if the level of the area is higher (smaller areas) then use the geocoding system
        if ($areaResults && $areaResults->level <= 5) {
            // Area can contain children which will need to be included on the search
            $descendants = Entry::find()
                ->section("areas")
                ->descendantOf($areaResults->id)
                ->all();

            // If any children exist
            if (count($descendants) > 0) {
                $dIds = [];

                // Get the descendant ids
                foreach ($descendants as $descendant) {
                    $dIds[] = $descendant->id;
                }

                // Build a query which includes dependants
                $query = Entry::find()
                    ->section("attractions")
                    ->attractionType($types)
                    ->relatedTo($dIds)
                    ->orderBy('title');
            } else {
                // Otherwise just get the attraction
                $query = Entry::find()
                    ->section("attractions")
                    ->attractionType($types)
                    ->relatedTo($areaResults)
                    ->orderBy('title');
            }
        } else {
            // run expensive query to search via postcode or non defined area
            $query = Entry::find()
                ->section("attractions")
                ->attractionType($types)
                ->attraction_location(['location' => $area.', Europe','radius'=> 15, 'unit' => 'mi'])
                ->orderBy('distance');
        }

        // Set images and types to be fetched as part of the query for performance
        if ($query) {
        $query->with(['attractionType','attraction_image']);
        }

        if ($types && is_array($types)) {
            $typesStr = implode('',$types);
        }
        else {
            $typesStr = '';
        }

        // Set the cache key
        $cacheKey = str_replace(' ','',$area . $typesStr);
        $results = $query->all();

        // Go through each result and build attraction data
        foreach ($results as $result) {
            /** @var Asset $img */
            $img = $result->attraction_image;

            // Create image url
            if ($img && $img[0]) {
                $img = $img[0]->getUrl();
            }

            // Create attraction data
            $attractionData[] = [
                'lat' => (float)$result->attraction_location->lat,
                'lon' => (float)$result->attraction_location->lng,
                'title' => $result->title,
                'types' => array_column($result->attractionType,'id'),
                'img' => $img ?: '',
                'summary' => $result->attraction_summary,
                'url' => $result->getUrl()
            ];
        }

        // Output data to the template
        return $this->renderTemplate('attractions/_area.twig', [
            'searchTerm' => $area,
            'mapview' => $usingMapView,
            'types' => $types,
            'attractions' => $results,
            'attractionsData' => $attractionData,
            'area' => $areaResults,
            'query' => $query,
            'cacheKey' => 'pageCache'.$cacheKey
        ]);
    }
}
