<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->delete();
        $companyRecord = [
            [
                'name' => 'ENEL',
                'code' => 'ENEL',
                'companyInfo' => json_encode([
                    'company_address' => '',
                    'company_phone' => '',
                    'url_logo' => 'https://enel.apprunn.com/images/logoSinExcusas.jpg',
                    'url_company' => 'https://enel.apprunn.com/images/logoEnel.png',
                    'url_icon' => 'https://enel.apprunn.com/images/favicon.ico',
                ]),
                'helpCenter' => json_encode(
                    [
                        'title' => 'Teminos y Condiciones',
                        'slug' => 'teminos-y-condiciones',
                        'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et ligula efficitur, facilisis erat auctor, faucibus nisl. Nunc varius nisi nulla, euismod rutrum risus eleifend nec. Etiam posuere aliquam sollicitudin. Proin placerat non libero varius vestibulum. Nullam sit amet feugiat felis. Nunc ut nibh sit amet nibh dignissim imperdiet quis quis felis. Nam at tristique sapien. Aenean commodo ante at tellus pulvinar, nec faucibus leo fringilla. Nullam purus augue, faucibus et interdum quis, elementum eu orci. Maecenas luctus neque ex, sit amet ullamcorper erat lobortis a. Maecenas iaculis lorem metus, in sodales mi vestibulum et. Nam auctor pretium enim at commodo.
                        Vivamus mattis cursus nisl, sit amet vulputate sapien ornare vitae. Cras a hendrerit arcu. Sed convallis orci enim, non ultrices urna pretium sed. Curabitur justo ipsum, porttitor eget sem ac, tincidunt fringilla ipsum. Donec sagittis convallis tellus, quis finibus lacus. Etiam porta leo diam, ac blandit enim rhoncus eleifend. Phasellus molestie lacinia gravida. Sed eu scelerisque dui. Vivamus commodo magna eget ligula condimentum elementum. Donec commodo tellus eu risus tristique hendrerit. Nulla interdum iaculis augue, id tincidunt turpis iaculis eu. Maecenas at efficitur ex. Nulla sed libero ac metus finibus molestie. Aliquam id facilisis felis.',
                        'seoTitle' => '',
                        'seoDescription' => '',
                        'seoImage' => '',
                    ]),
                'cookiePolicy' => json_encode([
                    'title' => 'Políticas de cookies',
                    'slug' => 'políticas-de-cookies',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et ligula efficitur, facilisis erat auctor, faucibus nisl. Nunc varius nisi nulla, euismod rutrum risus eleifend nec. Etiam posuere aliquam sollicitudin. Proin placerat non libero varius vestibulum. Nullam sit amet feugiat felis. Nunc ut nibh sit amet nibh dignissim imperdiet quis quis felis. Nam at tristique sapien. Aenean commodo ante at tellus pulvinar, nec faucibus leo fringilla. Nullam purus augue, faucibus et interdum quis, elementum eu orci. Maecenas luctus neque ex, sit amet ullamcorper erat lobortis a. Maecenas iaculis lorem metus, in sodales mi vestibulum et. Nam auctor pretium enim at commodo.
                    Vivamus mattis cursus nisl, sit amet vulputate sapien ornare vitae. Cras a hendrerit arcu. Sed convallis orci enim, non ultrices urna pretium sed. Curabitur justo ipsum, porttitor eget sem ac, tincidunt fringilla ipsum. Donec sagittis convallis tellus, quis finibus lacus. Etiam porta leo diam, ac blandit enim rhoncus eleifend. Phasellus molestie lacinia gravida. Sed eu scelerisque dui. Vivamus commodo magna eget ligula condimentum elementum. Donec commodo tellus eu risus tristique hendrerit. Nulla interdum iaculis augue, id tincidunt turpis iaculis eu. Maecenas at efficitur ex. Nulla sed libero ac metus finibus molestie. Aliquam id facilisis felis.',
                    'seoTitle' => '',
                    'seoDescription' => '',
                    'seoImage' => '',
                ]),
                'privacyPolicy' => json_encode([
                    'title' => 'Políticas de privacidad',
                    'slug' => 'políticas-de-privacidad',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et ligula efficitur, facilisis erat auctor, faucibus nisl. Nunc varius nisi nulla, euismod rutrum risus eleifend nec. Etiam posuere aliquam sollicitudin. Proin placerat non libero varius vestibulum. Nullam sit amet feugiat felis. Nunc ut nibh sit amet nibh dignissim imperdiet quis quis felis. Nam at tristique sapien. Aenean commodo ante at tellus pulvinar, nec faucibus leo fringilla. Nullam purus augue, faucibus et interdum quis, elementum eu orci. Maecenas luctus neque ex, sit amet ullamcorper erat lobortis a. Maecenas iaculis lorem metus, in sodales mi vestibulum et. Nam auctor pretium enim at commodo.
                    Vivamus mattis cursus nisl, sit amet vulputate sapien ornare vitae. Cras a hendrerit arcu. Sed convallis orci enim, non ultrices urna pretium sed. Curabitur justo ipsum, porttitor eget sem ac, tincidunt fringilla ipsum. Donec sagittis convallis tellus, quis finibus lacus. Etiam porta leo diam, ac blandit enim rhoncus eleifend. Phasellus molestie lacinia gravida. Sed eu scelerisque dui. Vivamus commodo magna eget ligula condimentum elementum. Donec commodo tellus eu risus tristique hendrerit. Nulla interdum iaculis augue, id tincidunt turpis iaculis eu. Maecenas at efficitur ex. Nulla sed libero ac metus finibus molestie. Aliquam id facilisis felis.',
                    'seoTitle' => '',
                    'seoDescription' => '',
                    'seoImage' => '',
                ]),
                'companySeo' => json_encode([
                    'title' => 'SEO para Compañia',
                    'description' => 'Esta es una compañia para SEO',
                    'url_image' =>'',
                ]),
                'beforeRegister' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam et ligula efficitur, facilisis erat auctor, faucibus nisl. Nunc varius nisi nulla, euismod rutrum risus eleifend nec. Etiam posuere aliquam sollicitudin. Proin placerat non libero varius vestibulum. Nullam sit amet feugiat felis. Nunc ut nibh sit amet nibh dignissim imperdiet quis quis felis. Nam at tristique sapien. Aenean commodo ante at tellus pulvinar, nec faucibus leo fringilla. Nullam purus augue, faucibus et interdum quis, elementum eu orci.',
            ],
        ];

        DB::table('companies')->insert($companyRecord);
    }
}
