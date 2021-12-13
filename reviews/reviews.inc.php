<?php 
//public page

//db connection
include("../php/connect.php");

$db = new mysqli($host,$uname,$pass,$database) or die("Database Connection Failed");?>

    
       
           
                <div class="slider">
                    <?php $sql = "SELECT * FROM reviews ORDER BY date_time DESC"; 
                        $img = ['profile_photo_url'];
                        $result = $db->query($sql) or die($db->error);
                        while($review = mysqli_fetch_array($result)){?>
                        <div class="review">
                             <div class="review-text-box">
                                 <img class="review-author-profile-img" src="<?php echo $review['profile_photo_url']?>" alt="">
                                    <div class="review-body">
                                        <h4 class="text-center"><a href="<?php echo $review['author_url'];?>"><?php echo $review['author_name'];?></a></h4>
                                        <div class="stars text-center">
                                            <i class="fa fa-star star-color <?php if($review['rating'] >=1){echo "star-color-rated";}?>"></i>
                                            <i class="fa fa-star star-color <?php if($review['rating'] >=2){echo "star-color-rated";}?>"></i>
                                            <i class="fa fa-star star-color <?php if($review['rating'] >=3){echo "star-color-rated";}?>"></i>
                                            <i class="fa fa-star star-color <?php if($review['rating'] >=4){echo "star-color-rated";}?>"></i>
                                            <i class="fa fa-star star-color <?php if($review['rating'] >=5){echo "star-color-rated";}?>"></i>
                                        </div>
                                        <p class="review-text"><?php echo $review['text'];?></p>
                                        <p class="review-time"><?php echo $review['relative_time'];?></p>
                                    </div>
                             </div>
                            
                        </div>
                    <?php } ?>
                </div>
            
        
    
