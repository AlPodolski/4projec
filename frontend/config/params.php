<?php
return [
    'adminEmail' => 'admin@example.com',
    'no_value_text' => 'Спроси меня',
    'advert_limit' => '40',
    'post_limit' => '12',
    'wall_items_limit' => '20',
    'wall_item_redis_key' => 'wall_item',
    'sort_url' => array('znakomstva', 'zhigalo', 'prostitutki'),
    'cache_name' => array(
        'detail_profile_cache_name' => '4dosug_profile_data_', //ключ по которому сохраняется кеш акнеты ( + ид пользователя )
        'city_info' => '4dosug_city_info_' //ключ по которому сохраняется кеш города ( + урл города )
    ),
];
