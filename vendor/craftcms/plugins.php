<?php

$vendorDir = dirname(__DIR__);
$rootDir = dirname(dirname(__DIR__));

return array (
  'verse/top100' => 
  array (
    'class' => 'verse\\top100\\Top100',
    'basePath' => $vendorDir . '/verse/top100/src',
    'handle' => 'top100',
    'aliases' => 
    array (
      '@verse/top100' => $vendorDir . '/verse/top100/src',
    ),
    'name' => 'top100',
    'version' => '1',
    'description' => 'top100 plugin',
    'developer' => 'Andrew Page',
    'developerUrl' => 'https://www.verse.co.uk/',
    'documentationUrl' => '???',
    'changelogUrl' => '???',
    'components' => 
    array (
      'top100' => 'verse\\top100\\services\\Top100',
    ),
  ),
  'carlcs/craft-redactorcustomstyles' => 
  array (
    'class' => 'carlcs\\redactorcustomstyles\\Plugin',
    'basePath' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    'handle' => 'redactor-custom-styles',
    'aliases' => 
    array (
      '@carlcs/redactorcustomstyles' => $vendorDir . '/carlcs/craft-redactorcustomstyles/src',
    ),
    'name' => 'Redactor Custom Styles',
    'version' => '3.0.4',
    'description' => 'Redactor Custom Styles plugin for Craft CMS',
    'developer' => 'carlcs',
    'developerUrl' => 'https://github.com/carlcs',
    'documentationUrl' => 'https://github.com/carlcs/craft-redactorcustomstyles',
    'changelogUrl' => 'https://github.com/carlcs/craft-redactorcustomstyles/raw/v3/CHANGELOG.md',
    'downloadUrl' => 'https://github.com/carlcs/craft-redactorcustomstyles/archive/v3.zip',
  ),
  'codemonauts/craft-instagram-feed' => 
  array (
    'class' => 'codemonauts\\instagramfeed\\InstagramFeed',
    'basePath' => $vendorDir . '/codemonauts/craft-instagram-feed/src',
    'handle' => 'instagramfeed',
    'aliases' => 
    array (
      '@codemonauts/instagramfeed' => $vendorDir . '/codemonauts/craft-instagram-feed/src',
    ),
    'name' => 'Instagram Feed',
    'version' => '1.1.8',
    'description' => 'Receive Instagram feeds.',
    'developer' => 'codemonauts',
    'developerUrl' => 'https://codemonauts.com',
    'documentationUrl' => 'https://plugins.codemonauts.com/plugins/instagramfeed/Introduction.html',
    'hasCpSection' => false,
  ),
  'craftcms/redactor' => 
  array (
    'class' => 'craft\\redactor\\Plugin',
    'basePath' => $vendorDir . '/craftcms/redactor/src',
    'handle' => 'redactor',
    'aliases' => 
    array (
      '@craft/redactor' => $vendorDir . '/craftcms/redactor/src',
    ),
    'name' => 'Redactor',
    'version' => '2.10.9',
    'description' => 'Edit rich text content in Craft CMS using Redactor by Imperavi.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/redactor/blob/v2/README.md',
  ),
  'craftcms/aws-s3' => 
  array (
    'class' => 'craft\\awss3\\Plugin',
    'basePath' => $vendorDir . '/craftcms/aws-s3/src',
    'handle' => 'aws-s3',
    'aliases' => 
    array (
      '@craft/awss3' => $vendorDir . '/craftcms/aws-s3/src',
    ),
    'name' => 'Amazon S3',
    'version' => '1.3.2',
    'description' => 'Amazon S3 integration for Craft CMS',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/aws-s3/blob/master/README.md',
  ),
  'craftcms/element-api' => 
  array (
    'class' => 'craft\\elementapi\\Plugin',
    'basePath' => $vendorDir . '/craftcms/element-api/src',
    'handle' => 'element-api',
    'aliases' => 
    array (
      '@craft/elementapi' => $vendorDir . '/craftcms/element-api/src',
    ),
    'name' => 'Element API',
    'version' => '2.8.6.1',
    'description' => 'Create a JSON API for your elements in Craft',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/element-api/blob/v2/README.md',
  ),
  'dolphiq/redirect' => 
  array (
    'class' => 'dolphiq\\redirect\\RedirectPlugin',
    'basePath' => $vendorDir . '/dolphiq/redirect/src',
    'handle' => 'redirect',
    'aliases' => 
    array (
      '@dolphiq/redirect' => $vendorDir . '/dolphiq/redirect/src',
    ),
    'name' => 'Redirect Manager',
    'version' => '1.1.1',
    'schemaVersion' => '1.0.5',
    'description' => 'Craft redirect plugin provides an easy way to enter and maintain 301 and 302 redirects and 404 error pages.',
    'developer' => 'Dolphiq',
    'developerUrl' => 'https://dolphiq.nl/',
    'documentationUrl' => 'https://github.com/Dolphiq/craft3-plugin-redirect/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/Dolphiq/craft3-plugin-redirect/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => true,
  ),
  'craftcms/feed-me' => 
  array (
    'class' => 'craft\\feedme\\Plugin',
    'basePath' => $vendorDir . '/craftcms/feed-me/src',
    'handle' => 'feed-me',
    'aliases' => 
    array (
      '@craft/feedme' => $vendorDir . '/craftcms/feed-me/src',
    ),
    'name' => 'Feed Me',
    'version' => '4.5.3',
    'description' => 'Import content from XML, RSS, CSV or JSON feeds into entries, categories, Craft Commerce products, and more.',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://docs.craftcms.com/feed-me/v4/',
  ),
  'dolphiq/sitemap' => 
  array (
    'class' => 'dolphiq\\sitemap\\Sitemap',
    'basePath' => $vendorDir . '/dolphiq/sitemap/src',
    'handle' => 'sitemap',
    'aliases' => 
    array (
      '@dolphiq/sitemap' => $vendorDir . '/dolphiq/sitemap/src',
    ),
    'name' => 'XML Sitemap',
    'version' => '1.3.2',
    'schemaVersion' => '1.0.2',
    'description' => 'Craft 3 plugin that provides an easy way to provide and manage a XML sitemap for search engines like Google and Bing',
    'developer' => 'Dolphiq',
    'developerUrl' => 'https://dolphiq.nl/',
    'documentationUrl' => 'https://github.com/Dolphiq/craft3-plugin-sitemap/blob/master/README.md',
    'changelogUrl' => 'https://github.com/Dolphiq/craft3-plugin-sitemap/blob/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
    'components' => 
    array (
      'sitemapService' => 'dolphiq\\sitemap\\services\\SitemapService',
    ),
  ),
  'craftcms/contact-form' => 
  array (
    'class' => 'craft\\contactform\\Plugin',
    'basePath' => $vendorDir . '/craftcms/contact-form/src',
    'handle' => 'contact-form',
    'aliases' => 
    array (
      '@craft/contactform' => $vendorDir . '/craftcms/contact-form/src',
    ),
    'name' => 'Contact Form',
    'version' => '2.5.1',
    'description' => 'Add a simple contact form to your Craft CMS site',
    'developer' => 'Pixel & Tonic',
    'developerUrl' => 'https://pixelandtonic.com/',
    'developerEmail' => 'support@craftcms.com',
    'documentationUrl' => 'https://github.com/craftcms/contact-form/blob/v2/README.md',
    'components' => 
    array (
      'mailer' => 'craft\\contactform\\Mailer',
    ),
  ),
  'hybridinteractive/craft-contact-form-extensions' => 
  array (
    'class' => 'hybridinteractive\\contactformextensions\\ContactFormExtensions',
    'basePath' => $vendorDir . '/hybridinteractive/craft-contact-form-extensions/src',
    'handle' => 'contact-form-extensions',
    'aliases' => 
    array (
      '@hybridinteractive/contactformextensions' => $vendorDir . '/hybridinteractive/craft-contact-form-extensions/src',
    ),
    'name' => 'Contact Form Extensions',
    'version' => '1.3.2',
    'schemaVersion' => '1.0.1',
    'description' => 'Adds extensions to the Craft CMS contact form plugin.',
    'developer' => 'Hybrid Interactive',
    'developerUrl' => 'https://hybridinteractive.io',
    'documentationUrl' => 'https://github.com/hybridinteractive/craft-contact-form-extensions/blob/master/README.md',
    'changelogUrl' => 'https://github.com/hybridinteractive/craft-contact-form-extensions/blob/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => true,
    'components' => 
    array (
      'contactFormExtensionsService' => 'hybridinteractive\\contactformextensions\\services\\ContactFormExtensionsService',
    ),
  ),
  'ether/simplemap' => 
  array (
    'class' => 'ether\\simplemap\\SimpleMap',
    'basePath' => $vendorDir . '/ether/simplemap/src',
    'handle' => 'simplemap',
    'aliases' => 
    array (
      '@ether/simplemap' => $vendorDir . '/ether/simplemap/src',
    ),
    'name' => 'Maps',
    'version' => '3.9.3',
    'schemaVersion' => '3.4.2',
    'description' => 'A beautifully simple Map field type for Craft CMS 3',
    'developer' => 'Ether Creative',
    'developerUrl' => 'https://ethercreative.co.uk',
    'developerEmail' => 'help@ethercreative.co.uk',
    'documentationUrl' => 'https://docs.ethercreative.co.uk/maps',
  ),
  'nystudio107/craft-minify' => 
  array (
    'class' => 'nystudio107\\minify\\Minify',
    'basePath' => $vendorDir . '/nystudio107/craft-minify/src',
    'handle' => 'minify',
    'aliases' => 
    array (
      '@nystudio107/minify' => $vendorDir . '/nystudio107/craft-minify/src',
    ),
    'name' => 'Minify',
    'version' => '1.2.11',
    'schemaVersion' => '1.0.0',
    'description' => 'A simple plugin that allows you to minify blocks of HTML, CSS, and JS inline in Craft CMS templates.',
    'developer' => 'nystudio107',
    'developerUrl' => 'https://nystudio107.com/',
    'documentationUrl' => 'https://nystudio107.com/plugins/minify/documentation',
    'changelogUrl' => 'https://raw.githubusercontent.com/nystudio107/craft-minify/v1/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
    'components' => 
    array (
      'minify' => 'nystudio107\\minify\\services\\MinifyService',
    ),
  ),
  'putyourlightson/craft-sendgrid' => 
  array (
    'class' => 'putyourlightson\\sendgrid\\Sendgrid',
    'basePath' => $vendorDir . '/putyourlightson/craft-sendgrid/src',
    'handle' => 'sendgrid',
    'aliases' => 
    array (
      '@putyourlightson/sendgrid' => $vendorDir . '/putyourlightson/craft-sendgrid/src',
    ),
    'name' => 'SendGrid',
    'version' => '1.2.3',
    'schemaVersion' => '1.0.0',
    'description' => 'SendGrid mailer adapter for Craft CMS.',
    'developer' => 'PutYourLightsOn',
    'developerUrl' => 'https://putyourlightson.com/',
    'documentationUrl' => 'https://putyourlightson.com/plugins/sendgrid',
    'changelogUrl' => 'https://raw.githubusercontent.com/putyourlightson/craft-sendgrid/v1/CHANGELOG.md',
  ),
  'sebastianlenz/linkfield' => 
  array (
    'class' => 'typedlinkfield\\Plugin',
    'basePath' => $vendorDir . '/sebastianlenz/linkfield/src',
    'handle' => 'typedlinkfield',
    'aliases' => 
    array (
      '@typedlinkfield' => $vendorDir . '/sebastianlenz/linkfield/src',
    ),
    'name' => 'Typed link field',
    'version' => '1.0.25',
    'description' => 'A Craft field type for selecting links',
    'developer' => 'Sebastian Lenz',
    'developerUrl' => 'https://github.com/sebastian-lenz/',
  ),
  'spicyweb/craft-embedded-assets' => 
  array (
    'class' => 'spicyweb\\embeddedassets\\Plugin',
    'basePath' => $vendorDir . '/spicyweb/craft-embedded-assets/src',
    'handle' => 'embeddedassets',
    'aliases' => 
    array (
      '@spicyweb/embeddedassets' => $vendorDir . '/spicyweb/craft-embedded-assets/src',
    ),
    'name' => 'Embedded Assets',
    'version' => '2.11.2',
    'schemaVersion' => '1.0.0',
    'description' => 'Manage YouTube videos, Instagram photos, Twitter posts and more as first class assets',
    'developer' => 'Spicy Web',
    'developerUrl' => 'https://spicyweb.com.au',
    'documentationUrl' => 'https://github.com/spicywebau/craft-embedded-assets/blob/2.11.2/README.md',
    'changelogUrl' => 'https://github.com/spicywebau/craft-embedded-assets/blob/master/CHANGELOG.md',
    'downloadUrl' => 'https://github.com/spicywebau/craft-embedded-assets/archive/master.zip',
  ),
  'ssplugin/ss-twitter-feed' => 
  array (
    'class' => 'ssplugin\\sstwitterfeed\\SsTwitterFeed',
    'basePath' => $vendorDir . '/ssplugin/ss-twitter-feed/src',
    'handle' => 'ss-twitter-feed',
    'aliases' => 
    array (
      '@ssplugin/sstwitterfeed' => $vendorDir . '/ssplugin/ss-twitter-feed/src',
    ),
    'name' => 'SS Twitter Feed',
    'version' => '1.0.8',
    'description' => 'Show Recent Tweets.',
    'developer' => 'SystemSeeders',
    'developerUrl' => 'http://www.systemseeders.com/',
    'documentationUrl' => 'https://github.com/ssplugin/ss-twitter-feed/blob/master/README.md',
    'changelogUrl' => 'https://github.com/ssplugin/ss-twitter-feed/blob/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
    'components' => 
    array (
      'ssTwitterFeedService' => 'ssplugin\\sstwitterfeed\\services\\SsTwitterFeedService',
    ),
  ),
  'vaersaagod/matrixmate' => 
  array (
    'class' => 'vaersaagod\\matrixmate\\MatrixMate',
    'basePath' => $vendorDir . '/vaersaagod/matrixmate/src',
    'handle' => 'matrixmate',
    'aliases' => 
    array (
      '@vaersaagod/matrixmate' => $vendorDir . '/vaersaagod/matrixmate/src',
    ),
    'name' => 'MatrixMate',
    'version' => '1.4.4',
    'schemaVersion' => '1.0.0',
    'description' => 'Welding Matrix into shape, mate!',
    'developer' => 'Værsågod',
    'developerUrl' => 'https://vaersaagod.no',
    'documentationUrl' => 'https://github.com/vaersaagod/matrixmate/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/vaersaagod/matrixmate/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
  ),
  'putyourlightson/craft-sprig' => 
  array (
    'class' => 'putyourlightson\\sprig\\plugin\\Sprig',
    'basePath' => $vendorDir . '/putyourlightson/craft-sprig/src',
    'handle' => 'sprig',
    'aliases' => 
    array (
      '@putyourlightson/sprig/plugin' => $vendorDir . '/putyourlightson/craft-sprig/src',
    ),
    'name' => 'Sprig',
    'version' => '1.13.0',
    'schemaVersion' => '1.0.1',
    'description' => 'A reactive Twig component framework for Craft.',
    'developer' => 'PutYourLightsOn',
    'developerUrl' => 'https://putyourlightson.com/',
    'documentationUrl' => 'https://putyourlightson.com/plugins/sprig',
    'changelogUrl' => 'https://raw.githubusercontent.com/putyourlightson/craft-sprig/v1/CHANGELOG.md',
  ),
  'vaersaagod/seomate' => 
  array (
    'class' => 'vaersaagod\\seomate\\SEOMate',
    'basePath' => $vendorDir . '/vaersaagod/seomate/src',
    'handle' => 'seomate',
    'aliases' => 
    array (
      '@vaersaagod/seomate' => $vendorDir . '/vaersaagod/seomate/src',
    ),
    'name' => 'SEOMate',
    'version' => '1.1.13',
    'description' => 'SEO, mate! It\'s important.',
    'developer' => 'Værsågod',
    'developerUrl' => 'https://www.vaersaagod.no/',
    'documentationUrl' => 'https://github.com/vaersaagod/seomate/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/vaersaagod/seomate/master/CHANGELOG.md',
    'hasCpSettings' => false,
    'hasCpSection' => false,
    'components' => 
    array (
    ),
  ),
  'verbb/image-resizer' => 
  array (
    'class' => 'verbb\\imageresizer\\ImageResizer',
    'basePath' => $vendorDir . '/verbb/image-resizer/src',
    'handle' => 'image-resizer',
    'aliases' => 
    array (
      '@verbb/imageresizer' => $vendorDir . '/verbb/image-resizer/src',
    ),
    'name' => 'Image Resizer',
    'version' => 'dev-verse-fork',
    'description' => 'Image Resizer resizes your assets when they are uploaded.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/image-resizer',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/image-resizer/craft-3/CHANGELOG.md',
  ),
  'verbb/super-table' => 
  array (
    'class' => 'verbb\\supertable\\SuperTable',
    'basePath' => $vendorDir . '/verbb/super-table/src',
    'handle' => 'super-table',
    'aliases' => 
    array (
      '@verbb/supertable' => $vendorDir . '/verbb/super-table/src',
    ),
    'name' => 'Super Table',
    'version' => '2.7.2',
    'description' => 'Super-charge your Craft workflow with Super Table. Use it to group fields together or build complex Matrix-in-Matrix solutions.',
    'developer' => 'Verbb',
    'developerUrl' => 'https://verbb.io',
    'developerEmail' => 'support@verbb.io',
    'documentationUrl' => 'https://github.com/verbb/super-table',
    'changelogUrl' => 'https://raw.githubusercontent.com/verbb/super-table/craft-3/CHANGELOG.md',
  ),
  'wbrowar/adminbar' => 
  array (
    'class' => 'wbrowar\\adminbar\\AdminBar',
    'basePath' => $vendorDir . '/wbrowar/adminbar/src',
    'handle' => 'admin-bar',
    'aliases' => 
    array (
      '@wbrowar/adminbar' => $vendorDir . '/wbrowar/adminbar/src',
    ),
    'name' => 'Admin Bar',
    'version' => '3.1.11',
    'schemaVersion' => '3.1.0',
    'description' => 'Front-end shortcuts for clients logged into Craft CMS.',
    'developer' => 'Will Browar',
    'developerUrl' => 'https://wbrowar.com/plugins/adminbar',
    'documentationUrl' => 'https://github.com/wbrowar/craft-3-adminbar/blob/master/README.md',
    'changelogUrl' => 'https://raw.githubusercontent.com/wbrowar/craft-3-adminbar/master/CHANGELOG.md',
    'hasCpSettings' => true,
    'hasCpSection' => false,
    'components' => 
    array (
      'bar' => 'wbrowar\\adminbar\\services\\Bar',
      'editLinks' => 'wbrowar\\adminbar\\services\\EditLinks',
    ),
  ),
);
