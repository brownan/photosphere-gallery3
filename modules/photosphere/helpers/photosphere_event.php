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

    $menu->append(Menu::factory("link")
                  ->id("photosphere")
                  ->label(t("View as Photosphere"))
                  ->url("javascript:new Photosphere('" . $theme->item()->file_url() . "').loadPhotosphere(document.getElementById('g-photo'));")
                  ->css_id("g-photosphere-link"));
  }

}
