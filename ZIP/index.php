if(!empty($zipDownload))
        {
            $tmpPath= DOCUMENT_PATH;
            $tmp_file = tempnam($tmpPath, 'zip_');
            $zip = new ZipArchive();
            if(!$zip->open($tmp_file, ZipArchive::CREATE))
            {
                exit("cannot open $tmp_file");
            }
            foreach($zipDownload as $file) 
            {
                if(file_exists($file))
                {
                    $zip->addFile($file,basename($file));
                }                    
            }
            $zip->close();
            header('Content-type: application/zip');
            header('Content-disposition: attachment; filename=report.zip');
            header("Pragma: no-cache"); 
            header("Expires: 0"); 
            readfile($tmp_file);
            //@unlink($tmp_file);
            
        }
