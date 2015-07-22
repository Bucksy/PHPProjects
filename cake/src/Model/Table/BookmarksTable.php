<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BookmarksTable
 *
 * @author nhuen
 */
class BookmarksTable {

    public function findTagged(Query $query, array $options) {
        return $this->find()->distinct(['Bookmarks.id'])->matching('Tags', function ($q) use ($options) {
                    return $q->where(['Tags.title IN' => $options['tags']]);
                });
    }

}
