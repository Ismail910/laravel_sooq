<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $permissions = [
        //     'roles' => ['show', 'create', 'update', 'delete'],
        //     'transactions' => ['show', 'create', 'update', 'delete'],
        //     'representatives' => ['show', 'create', 'update', 'delete'],
        //     'help-center' => ['show', 'create', 'update', 'delete'],
        //     'directory' => ['show', 'create', 'update', 'delete'],
        //     'voucher' => ['show', 'create', 'update', 'delete'],
        //     'sliders' => ['show', 'create', 'update', 'delete'],
        //     'announcements' => ['show', 'create', 'update', 'delete'],
        //     'countries' => ['show', 'create', 'update', 'delete'],
        //     'currencies' => ['show', 'create', 'update', 'delete'],
        //     'cities' => ['show', 'create', 'update', 'delete'],
        //     'states' => ['show', 'create', 'update', 'delete'],
        //     'stores' => ['show', 'create', 'update', 'delete'],
        //     'files' => ['show', 'create', 'update', 'delete'],
        //     'contacts' => ['show', 'create', 'update', 'delete'],
        //     'articles' => ['show', 'create', 'update', 'delete'],
        //     'menus' => ['show', 'create', 'update', 'delete'],
        //     'users' => ['show', 'create', 'update', 'delete'],
        //     'packages' => ['show', 'create', 'update', 'delete'],
        //     'subscriptions' => ['show', 'create', 'update', 'delete'],
        //     'pages' => ['show', 'create', 'update', 'delete'],
        //     'tables' => ['show', 'create', 'update', 'delete'],
        //     'contact-replies' => ['show', 'create', 'update', 'delete'],
        //     'faqs' => ['show', 'create', 'update', 'delete'],
        //     'menu-links' => ['show', 'create', 'update', 'delete'],
        //     'categories' => ['show', 'create', 'update', 'delete'],
        //     'redirections' => ['show', 'create', 'update', 'delete'],
        //     'traffics' => ['index'],
        //     'error-reports' => ['index', 'show'],
        //     'settings' => ['index', 'update'],
        // ];

        
        // foreach ($permissions as $key => $permission) {
        //     foreach($permission as $value) {
        //         $new_permission = Permission::create([
        //             'name' => $value . ' ' . $key
        //         ]);

        //         PermissionRole::create([
        //             'permission_id' => $new_permission->id,
        //             'role_id' => $role->id,
        //         ]);
        //     }
        // }

        $permissions = array(
            array('name' => 'show roles', 'ar_name' => 'عرض الأدوار', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create roles', 'ar_name' => 'إضافة الأدوار', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update roles', 'ar_name' => 'تعديل الأدوار', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete roles', 'ar_name' => 'حذف الأدوار', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show transactions', 'ar_name' => 'عرض المعاملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create transactions', 'ar_name' => 'إضافة المعاملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            // array('name' => 'update transactions', 'ar_name' => 'تعديل المعاملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            // array('name' => 'delete transactions', 'ar_name' => 'حذف المعاملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show representatives', 'ar_name' => 'عرض الممثلين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create representatives', 'ar_name' => 'إضافة الممثلين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update representatives', 'ar_name' => 'تعديل الممثلين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete representatives', 'ar_name' => 'حذف الممثلين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show help-center', 'ar_name' => 'عرض مركز المساعدة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create help-center', 'ar_name' => 'إضافة مركز المساعدة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update help-center', 'ar_name' => 'تعديل مركز المساعدة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete help-center', 'ar_name' => 'حذف مركز المساعدة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show directory', 'ar_name' => 'عرض الدليل', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create directory', 'ar_name' => 'إضافة الدليل', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update directory', 'ar_name' => 'تعديل الدليل', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete directory', 'ar_name' => 'حذف الدليل', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show voucher', 'ar_name' => 'عرض القسائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create voucher', 'ar_name' => 'إضافة قسائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update voucher', 'ar_name' => 'تعديل القسائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete voucher', 'ar_name' => 'حذف القسائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show sliders', 'ar_name' => 'عرض الشرائح', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create sliders', 'ar_name' => 'إضافة الشرائح', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update sliders', 'ar_name' => 'تعديل الشرائح', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete sliders', 'ar_name' => 'حذف الشرائح', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show announcements', 'ar_name' => 'عرض الإعلانات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create announcements', 'ar_name' => 'إضافة الإعلانات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update announcements', 'ar_name' => 'تعديل الإعلانات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete announcements', 'ar_name' => 'حذف الإعلانات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show countries', 'ar_name' => 'عرض الدول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create countries', 'ar_name' => 'إضافة الدول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update countries', 'ar_name' => 'تعديل الدول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete countries', 'ar_name' => 'حذف الدول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show currencies', 'ar_name' => 'عرض العملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create currencies', 'ar_name' => 'إضافة العملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update currencies', 'ar_name' => 'تعديل العملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete currencies', 'ar_name' => 'حذف العملات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show cities', 'ar_name' => 'عرض المدن', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create cities', 'ar_name' => 'إضافة المدن', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update cities', 'ar_name' => 'تعديل المدن', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete cities', 'ar_name' => 'حذف المدن', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show states', 'ar_name' => 'عرض الولايات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create states', 'ar_name' => 'إضافة الولايات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update states', 'ar_name' => 'تعديل الولايات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete states', 'ar_name' => 'حذف الولايات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show stores', 'ar_name' => 'عرض المتاجر', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create stores', 'ar_name' => 'إضافة المتاجر', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update stores', 'ar_name' => 'تعديل المتاجر', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete stores', 'ar_name' => 'حذف المتاجر', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show files', 'ar_name' => 'عرض الملفات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create files', 'ar_name' => 'إضافة الملفات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update files', 'ar_name' => 'تعديل الملفات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete files', 'ar_name' => 'حذف الملفات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show contacts', 'ar_name' => 'عرض جهات الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create contacts', 'ar_name' => 'إضافة جهات الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update contacts', 'ar_name' => 'تعديل جهات الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete contacts', 'ar_name' => 'حذف جهات الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'resolve contacts', 'ar_name' => 'إتمام جهات الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show articles', 'ar_name' => 'عرض المقالات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create articles', 'ar_name' => 'إضافة المقالات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update articles', 'ar_name' => 'تعديل المقالات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete articles', 'ar_name' => 'حذف المقالات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show menus', 'ar_name' => 'عرض القوائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create menus', 'ar_name' => 'إضافة القوائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update menus', 'ar_name' => 'تعديل القوائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete menus', 'ar_name' => 'حذف القوائم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show users', 'ar_name' => 'عرض المستخدمين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create users', 'ar_name' => 'إضافة المستخدمين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update users', 'ar_name' => 'تعديل المستخدمين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete users', 'ar_name' => 'حذف المستخدمين', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show packages', 'ar_name' => 'عرض الحزم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create packages', 'ar_name' => 'إضافة الحزم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update packages', 'ar_name' => 'تعديل الحزم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete packages', 'ar_name' => 'حذف الحزم', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show subscriptions', 'ar_name' => 'عرض الاشتراكات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create subscriptions', 'ar_name' => 'إضافة الاشتراكات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update subscriptions', 'ar_name' => 'تعديل الاشتراكات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete subscriptions', 'ar_name' => 'حذف الاشتراكات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show pages', 'ar_name' => 'عرض الصفحات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create pages', 'ar_name' => 'إضافة الصفحات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update pages', 'ar_name' => 'تعديل الصفحات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete pages', 'ar_name' => 'حذف الصفحات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show tables', 'ar_name' => 'عرض الجداول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create tables', 'ar_name' => 'إضافة الجداول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update tables', 'ar_name' => 'تعديل الجداول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete tables', 'ar_name' => 'حذف الجداول', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show contact-replies', 'ar_name' => 'عرض ردود الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create contact-replies', 'ar_name' => 'إضافة ردود الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update contact-replies', 'ar_name' => 'تعديل ردود الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete contact-replies', 'ar_name' => 'حذف ردود الاتصال', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show faqs', 'ar_name' => 'عرض الأسئلة الشائعة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create faqs', 'ar_name' => 'إضافة الأسئلة الشائعة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update faqs', 'ar_name' => 'تعديل الأسئلة الشائعة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete faqs', 'ar_name' => 'حذف الأسئلة الشائعة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show menu-links', 'ar_name' => 'عرض روابط القائمة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create menu-links', 'ar_name' => 'إضافة روابط القائمة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update menu-links', 'ar_name' => 'تعديل روابط القائمة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete menu-links', 'ar_name' => 'حذف روابط القائمة', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show categories', 'ar_name' => 'عرض الفئات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create categories', 'ar_name' => 'إضافة الفئات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update categories', 'ar_name' => 'تعديل الفئات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete categories', 'ar_name' => 'حذف الفئات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show redirections', 'ar_name' => 'عرض إعادة التوجيهات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'create redirections', 'ar_name' => 'إضافة إعادة التوجيهات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update redirections', 'ar_name' => 'تعديل إعادة التوجيهات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'delete redirections', 'ar_name' => 'حذف إعادة التوجيهات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show traffics', 'ar_name' => 'فهرسة التقارير', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show error-reports', 'ar_name' => 'فهرسة تقارير الأخطاء', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'show settings', 'ar_name' => 'فهرسة الإعدادات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08'),
            array('name' => 'update settings', 'ar_name' => 'تحديث الإعدادات', 'created_at' => '2023-05-13 13:07:08', 'updated_at' => '2023-05-13 13:07:08')
        );

        $role = Role::create([
            'name' => 'super admin'
        ]);

        foreach ($permissions as $key => $permission) {
            $new_permission = Permission::create($permission);

            PermissionRole::create([
                'permission_id' => $new_permission->id,
                'role_id' => $role->id,
            ]);
        }
    }
}
