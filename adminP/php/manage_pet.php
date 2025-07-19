<?php
require('top.inc.php');
$id='';
$categories_id='';
$name='';
$breed='';
$gender='';
$vaccination='';
$age='';

$about	='';
$image	='';
$msg='';
$image_required='required';



if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from pet where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$name=$row['name'];
		$breed=$row['breed'];
		$gender=$row['gender'];
		$vaccination=$row['vaccination'];
		$age=$row['age'];
		$about=$row['about'];
	}else{
		header('Location: pets.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=get_safe_value($con,$_POST['categories_id']);
	$name=get_safe_value($con,$_POST['name']);
	$breed=get_safe_value($con,$_POST['breed']);
	$gender=get_safe_value($con,$_POST['gender']);
	$vaccination=get_safe_value($con,$_POST['vaccination']);
	$age = get_safe_value($con,$_POST['age']);
    $age_unit = get_safe_value($con, $_POST['age_unit']);
	$about=get_safe_value($con,$_POST['about']);

	$age_with_unit = $age . ' ' . $age_unit;
	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){//updating image 
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],PET_IMAGE_SERVER_PATH.$image);
				$update_sql="update pet set categories_id='$categories_id',name='$name',breed='$breed',gender='$gender',vaccination='$vaccination',age='$age_with_unit',about='$about',image='$image' where id='$id'";
			}
			else
			{
				$update_sql="update pet set categories_id='$categories_id',name='$name',breed='$breed',gender='$gender',vaccination='$vaccination',age='$age_with_unit',about='$about' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			
			$image=rand(111111111,999999999).'_'.$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],PET_IMAGE_SERVER_PATH.$image);//
			mysqli_query($con,"insert into pet(categories_id,name,breed,gender,vaccination,age,about,image,status) values('$categories_id','$name','$breed','$gender','$vaccination','$age_with_unit','$about','$image',1)");
		}
		header('Location: pets.php');

		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Pet Form</strong></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
							<div class="form-group">
									<label for="categories" class=" form-control-label">Categories</label>
									<select class="form-control" name="categories_id">
										<option>Select Category</option>
										<?php
										$res=mysqli_query($con,"select id,categories from categories order by categories asc");
										while($row=mysqli_fetch_assoc($res)){
											if($row['id']==$categories_id){
												echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['categories']."</option>";
											}
											
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="categories" class=" form-control-label">Pet Name</label>
									<input type="text" name="name" placeholder="Enter pet's name" class="form-control" required value="<?php echo $name?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Pet Breed</label>
									<input type="text" name="breed" placeholder="Enter pet breed" class="form-control" required value="<?php echo $breed?>">
								</div>
								
								<div class="form-group">
									<label for="categories" class=" form-control-label">Gender</label>
									<select id="country" name="gender" class="form-control" required value="<?php echo $gender?>">
     								<option value="unknown">Unknown</option>
      								<option value="female">Female</option>
      								<option value="male">Male</option>
    								</select>
								</div>
								
								<div class="form-group">
   								<label for="vaccination" class="form-control-label">Vaccination</label>
								   <select name="vaccination" class="form-control">
    								<option value="vaccinated" <?php if($vaccination == 'vaccinated') echo 'selected'; ?>>Vaccinated</option>
    								<option value="not_vaccinated" <?php if($vaccination == 'not_vaccinated') echo 'selected'; ?>>Not Vaccinated</option>
									</select>
								</div>

								

								<div class="form-group">
									<label for="categories" class=" form-control-label">Image</label>
									<input type="file" name="image" class="form-control" <?php echo  $image_required?>>
								</div>
								
								<div class="form-group">
    							<label for="age" class=" form-control-label">Age</label>
    							<div style="display: flex; align-items: center;">
        							<input type="number" name="age" placeholder="Enter pet's age" class="form-control" style="width: auto; margin-right: 10px;" required value="<?php echo htmlspecialchars($age); ?>">
        							<select name="age_unit" class="form-control" style="width: auto;">
            						<option value="months">Months</option>
            						<option value="years">Years</option>
        						</select>
    							</div>
								</div>

								
								<div class="form-group">
									<label for="categories" class=" form-control-label">About</label>
									<textarea name="about" placeholder="Enter pet details" class="form-control" required><?php echo $about?></textarea>
								</div>

								
							   <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">Submit</button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
