<?php

/*
 * Fresns (https://fresns.org)
 * Copyright (C) 2021-Present Jevan Tang
 * Released under the Apache-2.0 License.
 */

namespace Plugins\ZhijieWeb\Config;

class ConfigInfo
{
    const NAMESPACE = 'ZhijieWeb';

    const ROUTE_NAME = 'zhijie-web';

    const ITEMS = [
        [
            'item_key' => 'zhijie_slogan',
            'item_value' => 'Information Community for Internet Practitioners',
            'item_type' => 'string', // number, string, boolean, array, object, file, plugin, plugins
            'item_tag' => 'themes',
            'is_multilingual' => true,
            'language_values' => [
                'en' => 'Information Community for Internet Practitioners',
                'zh-Hans' => '互联网从业者的资讯社区',
                'zh-Hant' => '網路從業人員的資訊社區',
            ],
        ],
        [
            'item_key' => 'zhijie_company_name',
            'item_value' => 'Name LLC',
            'item_type' => 'string',
            'item_tag' => 'themes',
            'is_multilingual' => true,
            'language_values' => [
                'en' => 'Name LLC',
                'zh-Hans' => '某某网络科技有限公司',
                'zh-Hant' => '某某網路科技有限公司',
            ],
        ],
        [
            'item_key' => 'zhijie_about',
            'item_value' => '',
            'item_type' => 'string',
            'item_tag' => 'themes',
            'is_multilingual' => true,
            'language_values' => [],
        ],
        [
            'item_key' => 'zhijie_sidebar',
            'item_value' => '',
            'item_type' => 'string',
            'item_tag' => 'themes',
            'is_multilingual' => true,
            'language_values' => [],
        ],
        [
            'item_key' => 'zhijie_footer',
            'item_value' => '',
            'item_type' => 'string',
            'item_tag' => 'themes',
            'is_multilingual' => true,
            'language_values' => [],
        ],
        [
            'item_key' => 'zhijie_app',
            'item_value' => '{"scheme":"zhijie","path":{"user":"pages/users/index","group":"pages/groups/index","hashtag":"pages/hashtags/index","post":"pages/posts/index","comment":"pages/comments/index","userDetail":"pages/profile/posts?fsid=","groupDetail":"pages/groups/detail?gid=","hashtagDetail":"pages/hashtags/detail?hid=","postDetail":"pages/posts/detail?pid=","commentDetail":"pages/comments/detail?cid="},"wechat":{"appId":"","mpAppId":""}}',
            'item_type' => 'object',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'zhijie_loading',
            'item_value' => 'true',
            'item_type' => 'boolean',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'zhijie_quick_publish',
            'item_value' => 'true',
            'item_type' => 'boolean',
            'item_tag' => 'themes',
        ],
        [
            'item_key' => 'zhijie_notifications',
            'item_value' => '["systems","mentions","comments","quotes"]',
            'item_type' => 'array',
            'item_tag' => 'themes',
        ],
    ];
}
