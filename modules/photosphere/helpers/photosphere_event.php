<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Photosphere - View Android photosphere pictures on Gallery3
 * Copyright (C) 2013 - Edouard Lafargue - edouard@lafargue.name
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class photosphere_event_Core {

  static function photo_menu($menu, $theme) {

   // Get XMP header for the item, and check whether this is a panorama
   $item = $theme->item();
    if ($item->is_photo() && $item->mime_type == "image/jpeg") {
        $exivDataRaw = array();
        $exivData = array();
        exec("exiv2 -p a " . escapeshellarg($item->file_path()), $exivDataRaw);
        foreach ($exivDataRaw as $line)
        {
            $tokens = preg_split('/\s+/', $line, 4);
            $exivData[ $tokens[0] ] = $tokens[3];
        }
        if ($exivData['Xmp.GPano.UsePanoramaViewer'] == "True" && $exivData['Xmp.GPano.ProjectionType'] == "equirectangular") {

            $menu->append(Menu::factory("link")
                      ->id("photosphere")
                      ->label(t("View as Photosphere"))
                      ->url("javascript: new Photosphere('" . urlencode(url::file("var/albums/".$item->relative_path())) . "').setEXIF({"
                        ."'full_width': " . intval($exivData['Xmp.GPano.FullPanoWidthPixels']) . ","
                        ."'full_height': " . intval($exivData['Xmp.GPano.FullPanoHeightPixels']) . ","
                        ."'crop_width': " . intval($exivData['Xmp.GPano.CroppedAreaImageWidthPixels']) . ","
                        ."'crop_height': " . intval($exivData['Xmp.GPano.CroppedAreaImageHeightPixels']) . ","
                        ."'x': " . intval($exivData['Xmp.GPano.CroppedAreaLeftPixels']) . ","
                        ."'y': " . intval($exivData['Xmp.GPano.CroppedAreaTopPixels'])
                      ."}).loadPhotosphere(document.getElementById('g-photo'));")
                      ->css_id("g-photosphere-link"));
        }
    }
  }

}
