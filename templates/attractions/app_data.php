{# Renders a json responce for use in the app, it duplicates the data format of the old json files the old live site used by the mobile apps #}

{% header "Content-Type: application/json" %}

{%- spaceless -%}
    {% set id = craft.app.request.queryParams['id'] %}
    {% set security = craft.app.request.queryParams['security'] %}
    {% set oldhash = craft.app.request.queryParams['hash'] %}
    {% set app = craft.entries.section('app').app_id(id).one() %}

    {% set areas = {} %}
    {% set types = {} %}
    {% set hash = app.dateUpdated|datetime('YmdHis') %}
    {% set cacheKey = 'appdata-' ~ id ~ '-' ~ security %}

    {% cache using key cacheKey for 30 days %}
        {% set attractions = craft.entries.section('attractions')
            .with(['attraction_area', 'attractionType', 'attraction_image', 'photos'])
            .relatedTo({ targetElement: app, field: 'aa_app_id'})
            .all()
        %}

        {# create variable to store attraction data for use later #}
        {% set attractionData %}
            {
            {% for attr in attractions %}
                {% set attrhash = attr.dateUpdated|datetime('YmdHis') %}
                {% if attrhash > hash %}
                    {% set hash = attrhash %}
                {% endif %}
                {# Check if area is deinfed before using it #}
                {% set area = attr.attraction_area[0] ?? null %}
                {% if area %}
                    {% if not attribute(areas, ('_'~area.id)) is defined %}
                        {% set areas = areas|merge({('_'~area.id):[attr.id]}) %}
                    {% else %}
                        {% set areas = areas|merge({('_'~area.id):(areas['_'~area.id]|merge([attr.id]))}) %}
                    {% endif %}
                {% endif %}
                {% set attrtypes = [] %}
                {% set types = attr.attractionType ?? null %}
                {% if types %}
                    {% for t in types %}
                        {% if t.id not in attrtypes %}
                            {% set attrtypes = attrtypes|merge([t.id]) %}
                        {% endif %}
                        {% if not attribute(types, '_'~t.id) is defined %}
                            {% set types = types|merge({('_'~t.id):[attr.id]}) %}
                        {% else %}
                            {% set types = types|merge({('_'~t.id):(types['_'~t.id]|merge([attr.id]))}) %}
                        {% endif %}
                    {% endfor %}
                {% endif %}
                "{{ attr.id }}": {
                "aa_app_id": "{{ app.app_id }}",
                "aa_attraction_id": "{{ attr.id }}",
                "attraction_id": "{{ attr.id }}",
                {% if area is defined and area %}
                    "attraction_area_id": "{{ area.id }}",
                {% else %}
                    "attraction_area_id": "",
                {% endif %}
                "attraction_slug": {{ attr.slug|json_encode()|raw }},
                "attraction_name": {{ attr.title|json_encode()|raw }},
                "attraction_summary": {% if not attr.attraction_summary is null %}{{ attr.attraction_summary|json_encode()|raw }}{% elseif not attr.attraction_review is null %}{{ attr.attraction_review|striptags|json_encode()|raw }}{% elseif not attr.attraction_description is null %}{{ attr.attraction_description|striptags|json_encode()|raw }}{% else %}""{% endif %},
                "attraction_description": {% if attr.attraction_description is null or attr.attraction_summary|length > attr.attraction_description|length %}{% if not attr.attraction_summary is null %}{{ attr.attraction_summary|json_encode()|raw }}{% elseif not attr.attraction_review is null %}{{ attr.attraction_review|striptags|json_encode()|raw }}{% else %}""{% endif %}{% else %}{{ attr.attraction_description|json_encode()|raw }}{% endif %},
                "attraction_address": {{ attr.attraction_address|json_encode()|raw }},
                "attraction_address2": {{ attr.attraction_address2|json_encode()|raw }},
                "attraction_town": {{ attr.attraction_town|json_encode()|raw }},
                "attraction_county": {{ attr.attraction_county|json_encode()|raw }},
                "attraction_postcode": {{ attr.attraction_postcode|json_encode()|raw }},
                "attraction_phone": {{ attr.attraction_phone|json_encode()|raw }},
                "attraction_email": {{ attr.attraction_email|json_encode()|raw }},
                "attraction_website": {{ attr.attraction_website|json_encode()|raw }},
                "attraction_facebook": {{ attr.attraction_facebook|json_encode()|raw }},
                "attraction_twitter": {{ attr.attraction_twitter|json_encode()|raw }},
                "attraction_instagram": {{ attr.attraction_instagram|json_encode()|raw }},
                {# Check if there is an image before using it #}
                {% set imageNode = attr.attraction_image[0] ?? null %}
                {% if imageNode %}
                    {% set image = imageNode.getUrl()|split('/') %}
                    "attraction_image": {{ image[image|length-1]|json_encode()|raw }},
                {% else %}
                    "attraction_image": "",
                {% endif %}
                "attraction_video_code": {{ attr.attraction_video_code|json_encode()|raw }},
                "attraction_review": {% if attr.attraction_review is null %}""{% else %}{{ attr.attraction_review|json_encode()|raw }}{% endif %},
                "attraction_trip_advisor": {% if attr.attraction_trip_advisor is null %}""{% else %}{{ attr.attraction_trip_advisor|json_encode()|raw }}{% endif %},
                "attraction_lat": {{ attr.attraction_location.lat|json_encode()|raw }},
                "attraction_long": {{ attr.attraction_location.lng|json_encode()|raw }},
                "attraction_status": "Active",
                "attraction_featured": {% if attr.attraction_featured %}"Yes"{% else %}"No"{% endif %},
                {# First photo check #}
                {% if attr.photos|length > 0 %}
                    {% set firstphoto = attr.photos[0] ?? null %}
                    {% set folder = firstphoto.getURL()|split('/')|slice(0,-1)|join('/') %}
                    "attraction_imagebank": {{ firstphoto.filename|json_encode()|raw }},
                    "attraction_gallery_folder": {{ folder|json_encode()|raw }},
                {% else %}
                    "attraction_imagebank": "",
                    "attraction_gallery_folder": "",
                {% endif %}
                "attraction_nationaltrust_member": {% if attr.attraction_nationaltrust_member %}"1"{% else %}"0"{% endif %},
                "attraction_order_priority": {{ attr.attraction_order_priority|json_encode()|raw }},
                "attraction_bookingcode": {{ attr.attraction_bookingcode|json_encode()|raw }},
                {% if area is defined and area %}
                    "map_type_id": "{% if attrtypes|length > 0 %}{{ attrtypes[0] }}{% endif %}",
                {% endif %}
                "map_attraction_id": "{{ attr.id }}",
                "types": "{{ attrtypes|join(',') }}",
                "photos": [
                {% set photos = attr.photos ?? null %}
                {% if photos %}
                    {% for photo in photos %}{
                        {%- set imageNode = photo -%}
                        {%- if imageNode -%}
                            {% set image = imageNode.getUrl()|split('/') %}
                            "photo_filename": {{ image[image|length-1]|json_encode()|raw }}
                        {%- endif -%}
                        }{% if not loop.last %},{% endif %}
                    {% endfor %}
                {% endif %}
                   ]
                }
                {% if not loop.last %},{% endif %}
            {% endfor %}
            }
        {% endset %}

        {# Getting types data for use later #}
        {% set typesData %}
            {
            {% for type in craft.categories.group('attractionType').all() %}
                {% set key = '_' ~ type.id %}
                {% set t = types[key] is defined?types[key]:[] %}
                {% set type = craft.categories.group('attractionType').id(type.id).one() %}
                {% set typehash = type.dateUpdated|datetime('YmdHis') %}
                {% if typehash > hash %}
                    {% set hash = typehash %}
                {% endif %}
                "{{ type.id }}": {
                "id":"{{ type.id }}",
                "name":{{ type?type.title|json_encode()|raw:null }},
                "parent_id":{{ type?type.parent?type.parent.id|json_encode()|raw:"0":"0" }},
                "attractions":{{ t|json_encode()|raw }}
                }
                {% if not loop.last %},{% endif %}
            {% endfor %}
            }
        {% endset %}

        {# Getting areas data for use later #}
        {% set areasData %}
            {
            {% set allareas = craft.entries.section('areas').all() %}
            {% set firstarea = true %}
            {% for area in allareas %}
                {% set key = '_' ~ area.id %}
                {% if areas[key] is defined %}
                    {% set t = areas[key] is defined?areas[key]:[] %}
                    {% set areahash = area.dateUpdated|datetime('YmdHis') %}
                    {% set areachildren = area.children().all() %}
                    {% if areahash > hash %}
                        {% set hash = areahash %}
                    {% endif %}
                    {% if not firstarea %},{% else %}{% set firstarea = false %}{% endif %}"{{ area.id }}": {
                    "id":"{{ area.id }}",
                    "parent":{{ area?area.parent?area.parent.id|json_encode()|raw:"0":"0" }},
                    "children": [{% for c in areachildren %}{{ c.id|json_encode()|raw }}{% if not loop.last %},{% endif %}{% endfor %}],
                    "name":{{ area?area.title|json_encode()|raw:null }},
                    "radius":{{ area.radius|json_encode()|raw }},
                    "lat": {{ area.area_position.lat|json_encode()|raw }},
                    "long": {{ area.area_position.lng|json_encode()|raw }},
                    "lat":{{ area.radius|json_encode()|raw }},
                    "attractions":{{ t|json_encode()|raw }}
                    }
                {% endif %}
            {% endfor %}
            }
        {% endset %}


    {# pulling all data together for render #}
        {
            "hash":{{ hash|json_encode()|raw }}{% if oldhash != hash %},
            "app": {
                "app_id":{{ app.app_id|json_encode()|raw }},
                "app_name":{{ app.title|json_encode()|raw }},
                "app_security":{{ app.app_security|json_encode()|raw }},
                "app_hash":{{ hash|json_encode()|raw }}
            },
            "attractions": {{ attractionData }},
            "types":{{ typesData }},
            "areas":{{ areasData }}{% endif %}
        }
    {% endcache %}

{%- endspaceless -%}