<?php
$image = 'Anja4.jpg';

$exif = exif_read_data($image, 0 , true);

foreach ($exif as $key => $section) {
    foreach ($section as $name => $val) {
        echo "$key.$name: $val\n";
    }
}

    if ($image != '') {
        error_reporting(0);

        $exif = exif_read_data($image, 0 , true);

        if(isset($exif["EXIF"]["DateTimeOriginal"])) {
            $fbdateoriginal = str_replace(":","-",substr($exif["EXIF"]["DateTimeOriginal"], 0, 10));
            $fbtimeoriginal = substr($exif["EXIF"]["DateTimeOriginal"], 10);
            print __('Datum:', 'photoblogfb') . " {$fbdateoriginal}";
            print __(' á Uhrzeit:', 'photoblogfb') . " {$fbtimeoriginal}";
            print "\n";
        }

        if(isset($exif["EXIF"]["FNumber"])) {
            list($num, $den) = explode("/",$exif["EXIF"]["FNumber"]);
            $fbaperture  = "F/" . ($num/$den);
            print __('Blende:', 'photoblogfb') . " {$fbaperture}";;
        }

        if(isset($exif["EXIF"]["ExposureTime"])) {
            list($num, $den) = explode("/", $exif["EXIF"]["ExposureTime"]);
            if ($num > $den) {
                $fbexposure = "{$num}s";
                print __(' á Belichtungsdauer:', 'photoblogfb') . " {$fbexposure}";
            } else {
                $den = round($den/$num);
                $fbexposure = "1/{$den}s";
                print __(' á Belichtungsdauer:', 'photoblogfb') . " {$fbexposure}";
            }
        }

        if(isset($exif["EXIF"]["FocalLength"])) {
            list($num, $den) = explode("/", $exif["EXIF"]["FocalLength"]);
            $fbfocallength  = ($num/$den) . "mm";
            print __(' á Brennweite:', 'photoblogfb') . " {$fbfocallength}";
        }

        if(isset($exif["EXIF"]["FocalLengthIn35mmFilm"])) {
            $fbfbfocallength35 = $exif["EXIF"]["FocalLengthIn35mmFilm"];
            print __(', (KB-Format entsprechend:', 'photoblogfb') . " {$fbfbfocallength35}" . __('mm)');
        }

        print "\n";

        if ( isset($exif["EXIF"]["ISOSpeedRatings"]) ) {
            print __('ISO:', 'photoblogfb') . " {$exif["EXIF"]["ISOSpeedRatings"]}";
        }

        if (isset($exif["EXIF"]["WhiteBalance"]) ) {
            switch($exif["EXIF"]["WhiteBalance"]) {
                case 0:
                    $fbwhitebalance = "Auto";
                    break;
                case 1:
                    $fbwhitebalance = "Daylight";
                    break;
                case 2:
                    $fbwhitebalance = "Fluorescent";
                    break;
                case 3:
                    $fbwhitebalance = "Incandescent";
                    break;
                case 4:
                    $fbwhitebalance = "Flash";
                    break;
                case 9:
                    $fbwhitebalance = "Fine Weather";
                    break;
                case 10:
                    $fbwhitebalance = "Cloudy";
                    break;
                case 11:
                    $fbwhitebalance = "Shade";
                    break;
                default:
                    $fbwhitebalance = '';
                    break;
            }
            print __(' á Wei§abgleich:', 'photoblogfb') . " {$fbwhitebalance}";
        }

        if (isset($exif["EXIF"]["Flash"]) ) {
            switch($exif["EXIF"]["Flash"]) {
                case 0:
                    $fbexif_flash = 'Flash did not fire';
                    break;
                case 1:
                    $fbexif_flash = 'Flash fired';
                    break;
                case 5:
                    $fbexif_flash = 'Strobe return light not detected';
                    break;
                case 7:
                    $fbexif_flash = 'Strobe return light detected';
                    break;
                case 9:
                    $fbexif_flash = 'Flash fired, compulsory flash mode';
                    break;
                case 13:
                    $fbexif_flash = 'Flash fired, compulsory flash mode, return light not detected';
                    break;
                case 15:
                    $fbexif_flash = 'Flash fired, compulsory flash mode, return light detected';
                    break;
                case 16:
                    $fbexif_flash = 'Flash did not fire, compulsory flash mode';
                    break;
                case 24:
                    $fbexif_flash = 'Flash did not fire, auto mode';
                    break;
                case 25:
                    $fbexif_flash = 'Flash fired, auto mode';
                    break;
                case 29:
                    $fbexif_flash = 'Flash fired, auto mode, return light not detected';
                    break;
                case 31:
                    $fbexif_flash = 'Flash fired, auto mode, return light detected';
                    break;
                case 32:
                    $fbexif_flash = 'No flash function';
                    break;
                case 65:
                    $fbexif_flash = 'Flash fired, red-eye reduction mode';
                    break;
                case 69:
                    $fbexif_flash = 'Flash fired, red-eye reduction mode, return light not detected';
                    break;
                case 71:
                    $fbexif_flash = 'Flash fired, red-eye reduction mode, return light detected';
                    break;
                case 73:
                    $fbexif_flash = 'Flash fired, compulsory flash mode, red-eye reduction mode';
                    break;
                case 77:
                    $fbexif_flash = 'Flash fired, compulsory flash mode, red-eye reduction mode, return light not detected';
                    break;
                case 79:
                    $fbexif_flash = 'Flash fired, compulsory flash mode, red-eye reduction mode, return light detected';
                    break;
                case 89:
                    $fbexif_flash = 'Flash fired, auto mode, red-eye reduction mode';
                    break;
                case 93:
                    $fbexif_flash = 'Flash fired, auto mode, return light not detected, red-eye reduction mode';
                    break;
                case 95:
                    $fbexif_flash = 'Flash fired, auto mode, return light detected, red-eye reduction mode';
                    break;
                default:
                    $fbexif_flash = '';
                    break;
                }
                print __(' á Blitz:', 'photoblogfb') . " {$fbexif_flash}";
        }
    }
?>