<?php
header("Access-Control-Allow-Origin: *");//设置允许跨域，用来判断题目环境是否开启
if (!empty($_FILES)):

$ext = pathinfo($_FILES['file_upload']['name'], PATHINFO_EXTENSION);
if (!in_array($ext, ['gif', 'png', 'jpg', 'jpeg'])) {
    die('不允许的文件类型.');
}

$new_name = 'uploadfiles/' . $_FILES['file_upload']['name'];
if(!move_uploaded_file($_FILES['file_upload']['tmp_name'], $new_name)){
    die('上传目录无写权限.');
}

die('上传成功，文件路径: ' . $new_name);

else:
?>
<h2>本页面使用白名单过滤</h2>
<form method="post" enctype="multipart/form-data">
    请上传图片: <input type="file" name="file_upload">
    <input type="submit">
</form>
<?php
endif;