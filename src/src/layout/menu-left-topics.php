<div class="card">
	<article class="card-group-item">
		<header class="card-header"><h3 class="title">View by Topics </h3></header>
		<div class="filter-content">
            <div class="list-group list-group-flush">
            <?php
            // TOPIC
            $query = 'SELECT * FROM topics';
            $topicList = executeResult($query);
            foreach ($topicList as $topic): ?>
                <a class="list-group-item" href="blog.php?topic_id=<?php echo $topic['id']; ?>"><?php echo $topic['topic_name'] ?></a>
            <?php endforeach; ?>
            </div>  <!-- list-group .// -->
            <form method="get">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search by title name" id="titlename" name="titlename">
                    <button type="submit" class="btn btn-success" style="margin-block-start: 10px;">Search</button>
                </div>
            </form>
		</div>
	</article> <!-- card-group-item.// -->
    <div class="banner-left">
        <a href="#">
            <img src="img/product/banner_left.jpg" alt="">
        </a>
    </div>
</div> <!-- card.// -->