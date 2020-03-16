<?php

use Adianti\Widget\Menu\TMenu;

class AdiantiMenuBuilder
{
    public static function parse($file, $theme)
    {
        switch ($theme) {
            case 'theme1':
                ob_start();
                $callback = array('SystemPermission', 'checkPermission');
                $xml = new SimpleXMLElement(file_get_contents($file));
                $menu = new TMenu($xml, $callback, 1, 'dropdown-menu');
                $menu->class = 'sidebar-menu';
                $menu->id = 'side-menu';
                $menu->show();
                $menu_string = ob_get_clean();

                $menu_string = str_replace('<ul class="sidebar-menu" id="side-menu">', '', $menu_string);
                $menu_string = substr($menu_string, 0, -6);

                return $menu_string;
                break;
            case 'theme3':
                ob_start();
                $callback = array('SystemPermission', 'checkPermission');
                $xml = new SimpleXMLElement(file_get_contents($file));
                $menu = new TMenu($xml, $callback, 1, 'treeview-menu', 'treeview', '');
                $menu->class = 'sidebar-menu';
                $menu->id = 'side-menu';
                $menu->show();
                $menu_string = ob_get_clean();
                return $menu_string;
                break;
            default:
                ob_start();
                $callback = array('SystemPermission', 'checkPermission');
                $xml = new SimpleXMLElement(file_get_contents($file));
                $menu = new TMenu($xml, $callback, 1, 'ml-menu', 'x', 'menu-toggle waves-effect waves-block');

                $li = new TElement('li');
                $li->{'class'} = 'active';
                $menu->add($li);

                $li = new TElement('li');
                $li->add('MENU PRINCIPAL');
                $li->{'class'} = 'header';
                $menu->add($li);

                $menu->class = 'list';
                $menu->style = 'overflow: hidden; width: auto; height: 390px;';
                $menu->show();
                $menu_string = ob_get_clean();
                return $menu_string;
                break;
        }
    }
}
