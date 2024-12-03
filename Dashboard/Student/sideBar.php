<?php


?>


<aside id="sidebar1" class="rounded-4 sticky-top">
    <div class="h-100">

        <ul class="sidebar-nav">
            <li class="h5 p-3 opacity-75 text-center">
                Contents
            </li>
            <li class="card mx-2 mb-1">
                <a href="subject.php?week=week1&subject=<?php echo $clickedSubject; ?>" class="sidebar-link">
                    Week 1 - <?php echo "{$row1['week1']}"; ?>
                </a>
            </li>
            <li class="card mx-2 mb-1">
                <a href="subject.php?week=week2&subject=<?php echo $clickedSubject; ?>" class="sidebar-link ">
                    Week 2 - <?php echo "{$row1['week2']}"; ?>
                </a>
            </li>
            <li class="card mx-2 mb-1">
                <a href="subject.php?week=week3&subject=<?php echo $clickedSubject; ?>" class="sidebar-link ">
                    Week 3 - <?php echo "{$row1['week3']}"; ?>
                </a>
            </li>
            <li class="card mx-2 mb-1">
                <a href="subject.php?week=week4&subject=<?php echo $clickedSubject; ?>" class="sidebar-link ">
                    Week 4 - <?php echo "{$row1['week4']}"; ?>
                </a>
            </li>
        </ul>

    </div>
</aside>