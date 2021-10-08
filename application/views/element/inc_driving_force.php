<?php 
 /**
 * @param1 slider category value 1 or empty param for top slider ex. getSlider() or getSlider(1)
 * @param1 slider category value 2 for bottom slider ex. getSlider(2)
 * @param2 slider limit default 10 ex getSlider(1,5) :- top slider and limt 5
 **/
 
 $DrivingForceRec = getDrivingForce(10);
 if(count($DrivingForceRec)>0):
?> 
<!-- banner --> 

	<?php foreach($DrivingForceRec as $row): ?>
        <div>
            <div class="cm"> <img src="uploads/files/<?php echo $row->attachment; ?>" alt="<?php echo $row->designation; ?>" width="200">
                <h4> <?php echo $row->title; ?> </h4>
                <p><?php echo $row->designation; ?></p>
             </div>
        </div>

	<?php endforeach; ?>

<?php endif; ?>

