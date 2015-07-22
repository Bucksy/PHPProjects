<?php

// exit(var_dump($articles));?>
<h1>Blog Articles </h1>
<?php echo $this->Html->link('Add Article', ['action' => 'add']);?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Created</th>
    </tr>

    <?php foreach ($articles as $article): ?>
    <tr>
        <td>
            <?php echo $article->id ?>
        </td>
        <td>
            <?php echo $this->Html->link($article->title, ['action' => 'view', $article->id]);
             ?> 
        </td>
        
        <td>
            <?php echo $article->created->format(DATE_RFC850)?>
        </td>
        <td>
            <?= $this->Html->link('Edit', ['action' => 'edit', $article->id]); ?>
        </td>
        <td>
            <?= $this->Html->link('Delete', ['action' => 'delete', $article->id]); ?>
        </td>
    </tr>
    <?php endforeach;?>
</table>