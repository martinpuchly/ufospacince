<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    #PERMISSION
        Permission::insert(['main_name' => 'Stránka', 'name' => 'Povolenia', 'key' => 'permissions', 'route' => 'admin.permissions', 'link_in_admin_menu' => 1]);

    #GROUPS
        Permission::insert(['main_name' => 'Stránka', 'name' => 'Skupiny', 'key' => 'groups', 'route' => 'admin.groups', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Stránka', 'name' => 'pridať skupinu', 'key' => 'group-add', 'route' => 'admin.group.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Stránka', 'name' => 'upraviť skupinu', 'key' => 'group-edit', 'route' => 'admin.group.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Stránka', 'name' => 'vymazať skupinu', 'key' => 'group-delete', 'route' => 'admin.group.edit', 'link_in_admin_menu' => 0]);
    #GROUPS - PERMISSION
        Permission::insert(['main_name' => 'Stránka', 'name' => 'povolenia skupiny', 'key' => 'group-permissions', 'route' => 'admin.permissions.group', 'link_in_admin_menu' => 0]);

    #USERS
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'UŽÍVATEĽIA', 'key' => 'admin-users', 'route' => 'admin.users', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'vymazať užívateľa', 'key' => 'admin-user-delete', 'route' => 'admin.user.delete', 'link_in_admin_menu' => 0]);

    #USERS - PERMISSION
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'povolenia užívateľa', 'key' => 'user-permissions', 'route' => 'admin.permissions.user', 'link_in_admin_menu' => 0]);

    #USERS - GROUPS
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'skupiny užívateľa', 'key' => 'user-groups', 'route' => 'admin.groups.user', 'link_in_admin_menu' => 0]);

    #PLAYERS
        Permission::insert(['main_name' => 'Tím', 'name' => 'Hráči', 'key' => 'admin-players', 'route' => 'admin.players', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'vytvoriť hráča', 'key' => 'player-add', 'route' => 'admin.player.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'upraviť hráča', 'key' => 'player-edit', 'route' => 'admin.player.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'vymazať hráča', 'key' => 'player-delete', 'route' => 'admin.player.delete', 'link_in_admin_menu' => 0]);
        
        Permission::insert(['main_name' => 'Tím', 'name' => 'trvale vymazať hráča', 'key' => 'player-destroy', 'route' => 'player.destroy', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'obnoviť hráča', 'key' => 'player-restore', 'route' => 'player.delete', 'link_in_admin_menu' => 0]);
        
        Permission::insert(['main_name' => 'Tím', 'name' => 'prideliť hráča registrácii', 'key' => 'player-set-user', 'route' => 'player.setUser', 'link_in_admin_menu' => 0]);

    #TRAININGS
        Permission::insert(['main_name' => 'Tím', 'name' => 'Tréningy', 'key' => 'trainings', 'route' => 'admin.trainings', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'vytvoriť tréning', 'key' => 'training-add', 'route' => 'admin.training.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'upraviť tréning', 'key' => 'training-edit', 'route' => 'admin.training.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Tím', 'name' => 'vymazať tréning', 'key' => 'training-destroy', 'route' => 'admin.training.delete', 'link_in_admin_menu' => 0]);
        
        Permission::insert(['main_name' => 'Tím', 'name' => 'účasť na tréningu', 'key' => 'training-presence', 'route' => 'admin.training.presence', 'link_in_admin_menu' => 0]);


    #POSTS
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'ČLÁNKY', 'key' => 'posts', 'route' => 'admin.posts', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vytvoriť článok', 'key' => 'post-add', 'route' => 'admin.post.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'upraviť článok', 'key' => 'post-edit', 'route' => 'admin.post.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vymazať článok', 'key' => 'post-delete', 'route' => 'admin.post.delete', 'link_in_admin_menu' => 0]);
        
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'trvale vymazať článok', 'key' => 'post-destroy', 'route' => 'admin.post.destroy', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'obnoviť článok', 'key' => 'post-restore', 'route' => 'admin.post.delete', 'link_in_admin_menu' => 0]);

    #PAGES
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'STRÁNKY', 'key' => 'pages', 'route' => 'admin.pages', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vytvoriť stránku', 'key' => 'page-add', 'route' => 'admin.page.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'upraviť stránku', 'key' => 'page-edit', 'route' => 'admin.page.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vymazať stránku', 'key' => 'page-delete', 'route' => 'admin.page.delete', 'link_in_admin_menu' => 0]);
        
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'trvale vymazať stránku', 'key' => 'page-destroy', 'route' => 'admin.page.destroy', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'obnoviť stránku', 'key' => 'page-restore', 'route' => 'admin.page.delete', 'link_in_admin_menu' => 0]);

    #SLIDES
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'SLIDERS', 'key' => 'slides', 'route' => 'admin.slides', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vytvoriť slide', 'key' => 'slide-add', 'route' => 'admin.slide.add', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'upraviť slide', 'key' => 'slide-edit', 'route' => 'admin.slide.edit', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Obsah stránky', 'name' => 'vymazať slide', 'key' => 'slide-delete', 'route' => 'admin.slide.delete', 'link_in_admin_menu' => 0]);

   
   
   
    #CONTACTS
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'Správy od užívateľov', 'key' => 'contacts', 'route' => 'admin.contacts', 'link_in_admin_menu' => 1]);
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'Správy od užívateľov - čítať', 'key' => 'contact-show', 'route' => 'admin.contact.show', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'Správy od užívateľov - meniť status', 'key' => 'contact-saveStatus', 'route' => 'admin.contact.saveStatus', 'link_in_admin_menu' => 0]);
        Permission::insert(['main_name' => 'Používateľia', 'name' => 'Správy od užívateľov - vymazať', 'key' => 'contact-destroy', 'route' => 'admin.contact.saveStatus', 'link_in_admin_menu' => 0]);
       
       
    #SETTINGS 
    Permission::insert(['main_name' => 'Stránka', 'name' => 'Nastavenia', 'key' => 'settings', 'route' => 'admin.settings', 'link_in_admin_menu' => 1]);

   
   
    }

}



