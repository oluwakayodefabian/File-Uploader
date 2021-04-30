<?php defined('BASEPATH') OR exit('No direct script access allowed')?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>File_upload</title>
        <link rel="stylesheet" href="<?=base_url('assets/css/style.css')?>">
    </head>
    <body>
        <div class="input-box">
            <?=form_open_multipart('file_upload/upload_file')?>
                <input type="file" name="file" class="input-text">
                <button type="submit">Upload</button>
                <?=$error?>
            <?=form_close()?>
        </div>
        <table>
            <thead>
                <th>SN</th>
                <th>Name</th>
                <th>Size in mb</th>
                <th>Dowloads</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($files as $key => $file):?>
                    <tr>
                        <td><?=$key + 1?></td>
                        <td><?=$file->name?></td>
                        <td><?=$file->size / 1000?></td>
                        <td><?=$file->downloads?></td>
                        <td><a class="download" href="<?=site_url('file_upload/download/'.$file->id)?>">Download</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </body>
</html>
