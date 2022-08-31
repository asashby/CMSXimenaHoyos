<?php

namespace Database\Seeders;

use DateTime;
use DateTimeZone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $fecha = new DateTime('now', new DateTimeZone('America/Lima'));
        DB::table('recipes')->delete();
        $recipesRecords = [
            [
                'id' => 1,
                'title' => 'Receta 1',
                'description' => 'Viva la Generacion del Bicentenario',
                'slug' => 'receta-1',
                'route' => 'receta-1',
                'page_image' => 'recipes/images/recipes.jpg',
                'attributes' => json_encode([
                    json_encode(['kcal' => '150']),
                    json_encode(['grasas' => '200']),
                    json_encode(['carbohidratos' => '150']),
                ]),
                'ingredients' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'images' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'steps' => json_encode([
                    json_encode([
                        'step1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step3' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step4' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step5' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                ]),
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 2,
                'title' => 'Receta 2',
                'description' => 'Viva la Generacion del Bicentenario',
                'slug' => 'receta-2',
                'route' => 'receta-2',
                'page_image' => 'recipes/images/recipes.jpg',
                'attributes' => json_encode([
                    json_encode(['kcal' => '150']),
                    json_encode(['grasas' => '200']),
                    json_encode(['carbohidratos' => '150']),
                ]),
                'ingredients' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'images' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'steps' => json_encode([
                    json_encode([
                        'step1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step3' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step4' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step5' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                ]),
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 3,
                'title' => 'Receta 3',
                'description' => 'Viva la Generacion del Bicentenario',
                'slug' => 'receta-3',
                'route' => 'receta-3',
                'page_image' => 'recipes/images/recipes.jpg',
                'attributes' => json_encode([
                    json_encode(['kcal' => '150']),
                    json_encode(['grasas' => '200']),
                    json_encode(['carbohidratos' => '150']),
                ]),
                'ingredients' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'images' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'steps' => json_encode([
                    json_encode([
                        'step1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step3' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step4' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step5' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                ]),
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
            [
                'id' => 4,
                'title' => 'Receta 4',
                'description' => 'Viva la Generacion del Bicentenario',
                'slug' => 'receta-4',
                'route' => 'receta-4',
                'page_image' => 'recipes/images/recipes.jpg',
                'attributes' => json_encode([
                    json_encode(['kcal' => '150']),
                    json_encode(['grasas' => '200']),
                    json_encode(['carbohidratos' => '150']),
                ]),
                'ingredients' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'images' => json_encode([
                    'ingrediente1',
                    'ingrediente2',
                    'ingrediente3',
                    'ingrediente4',
                    'ingrediente5',
                ]),
                'steps' => json_encode([
                    json_encode([
                        'step1' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step2' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step3' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step4' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                    json_encode([
                        'step5' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In luctus enim eros, non sagittis tellus pulvinar vitae. Duis eros enim, viverra quis lacus sit amet, rhoncus suscipit nisl. Nunc volutpat neque vitae massa varius tincidunt. Morbi tincidunt faucibus lacus, non imperdiet massa convallis venenatis. Donec sed mi in risus semper blandit sit amet id ex. Sed in luctus nisl, ac semper dolor. Quisque orci justo, mollis et ipsum at, convallis semper metus. Pellentesque lacinia ligula neque, sit amet semper augue sodales consectetur.'
                    ]),
                ]),
                'published_at' => $fecha,
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ],
        ];

        DB::table('recipes')->insert($recipesRecords);
    }
}
