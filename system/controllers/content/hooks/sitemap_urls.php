<?php

class onContentSitemapUrls extends cmsAction {

    public function run($ctype_name){

        $urls = array();
        $action = 'items';

        if (empty($ctype_name)) { return $urls; }

        if(is_array($ctype_name)){
            list($ctype_name, $action) = $ctype_name;
        }

		$ctype = $this->model->getContentTypeByName($ctype_name);
		if (!$ctype) { return $urls; }

        if($action == 'items'){

            if(cmsPermissions::getRuleSubjectPermissions('content', $ctype_name, 'view_list')){
                return $urls;
            }

            $items = $this->model->limit(false)->getContentItemsForSitemap($ctype_name);

            if ($items){
                foreach($items as $item){
                    $urls[] = array(
                        'last_modified' => $item['date_last_modified'],
                        'title'         => $item['title'],
                        'url'           => href_to_abs($ctype_name, $item['slug'] . '.html')
                    );
                }
            }

        }

        if($action == 'cats' && $ctype['is_cats']){

            $items = $this->model->limit(false)->getCategoriesTree($ctype_name, false);

            if ($items){
                foreach($items as $item){
                    $urls[] = array(
                        'last_modified' => null,
                        'title'         => $item['title'],
                        'url'           => href_to_abs($ctype_name, $item['slug'])
                    );
                }
            }

        }

        return $urls;

    }

}
