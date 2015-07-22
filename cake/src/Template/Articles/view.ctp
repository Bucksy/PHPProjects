
<h1>Your Article </h1>
<p><?php echo h($article->title); ?></p>
<p><?php echo h($article->body); ?></p>
<p><?php echo $article->created->format(DATE_RFC850); ?></p>