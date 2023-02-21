<?php
    function formatBytes($bytes, $precision = 0) { 
        $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

        $bytes = max($bytes, 0); 
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
        $pow = min($pow, count($units) - 1); 

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow]; 
    }

    function get_type($type, $name="",$show){
        if(strpos($type, 'excel') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_exc.png'/>";
                    break;
                case 'type':
                    return "Excel Spreadsheet";
                    break;
            }
        }
        else if(strpos($type, 'pdf') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_pdf.png'/>";
                    break;
                case 'type':
                    return "PDF Document";
                    break;
            }
        }
        else if(strpos($type, 'zip') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_archive.png'/>";
                    break;
                case 'type':
                    return "ZIP Archive";
                    break;
            }
        }
        else if(strpos($type, 'pdf') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_archive.png'/>";
                    break;
                case 'type':
                    return "RAR Archive";
                    break;
            }
        }
        else if(strpos($type, 'audio') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_audio.png'/>";
                    break;
                case 'type':
                    return "Audio File";
                    break;
            }
        }
        else if(strpos($type, 'openxmlformats') !== false){
            if(strpos($name, 'doc') !== false){
                switch($show){
                    case 'icon':
                        return "<img src='../assets/img/icon_doc.png'/>";
                        break;
                    case 'type':
                        return "Word Document";
                        break;
                }
            }
            else if(strpos($name, 'ppt') !== false){
                switch($show){
                    case 'icon':
                        return "<img src='../assets/img/icon_ppt.png'/>";
                        break;
                    case 'type':
                        return "PowerPoint Presentation";
                        break;
                }
            }
            else if(strpos($name, 'xlsx') !== false){
                switch($show){
                    case 'icon':
                        return "<img src='../assets/img/icon_exc.png'/>";
                        break;
                    case 'type':
                        return "Excel Spreadsheet";
                        break;
                }
            }
            else{
                switch($show){
                    case 'icon':
                        return "<img src='../assets/img/icon_file.png'/>";
                        break;
                    case 'type':
                        return "File";
                        break;
                }
            }
        }
        else if(strpos($type, 'image') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_pic.png'/>";
                    break;
                case 'type':
                    return "Image File";
                    break;
            }
        }
        else if(strpos($type, 'video') !== false){
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_video.png'/>";
                    break;
                case 'type':
                    return "Video File";
                    break;
            }
        }
        else{
            switch($show){
                case 'icon':
                    return "<img src='../assets/img/icon_file.png'/>";
                    break;
                case 'type':
                    return "File";
                    break;
            }
        }
    }
?>