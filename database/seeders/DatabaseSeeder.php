<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
        $now = Carbon::now();

         DB::table('categorias')->insert([
            ['id'=>1,'nombre'=>'Comida','slug'=>'comida','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'nombre'=>'Bebidas','slug'=>'bebidas','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'nombre'=>'Postres','slug'=>'postres','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'nombre'=>"Snack’s",'slug'=>'snack','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
            ['id'=>5,'nombre'=>'Panadería','slug'=>'panaderia','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,'nombre'=>'Productos de temporada','slug'=>'producto_temporada','icono'=>'bi-folder','created_at'=>$now,'updated_at'=>$now],
        ]);

        // SUBCATEGORIAS
        DB::table('subcategorias')->insert([
            ['id'=>1,'nombre'=>'Tacos','slug'=>'tacos','icono'=>'bi-tag','categoria_id'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'nombre'=>'Hamburguesas','slug'=>'hamburguesas','icono'=>'bi-tag','categoria_id'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'nombre'=>'Pizza','slug'=>'pizza','icono'=>'bi-tag','categoria_id'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'nombre'=>'Refrescos','slug'=>'refrescos','icono'=>'bi-tag','categoria_id'=>2,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>5,'nombre'=>'Café','slug'=>'cafe','icono'=>'bi-tag','categoria_id'=>2,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,'nombre'=>'Helados','slug'=>'helados','icono'=>'bi-tag','categoria_id'=>3,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>7,'nombre'=>'Chips','slug'=>'chips','icono'=>'bi-tag','categoria_id'=>4,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>8,'nombre'=>'Galletas','slug'=>'galletas','icono'=>'bi-tag','categoria_id'=>4,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>9,'nombre'=>'Pan dulce','slug'=>'pan_dulce','icono'=>'bi-tag','categoria_id'=>5,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>10,'nombre'=>'Bollería','slug'=>'bolleria','icono'=>'bi-tag','categoria_id'=>5,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>11,'nombre'=>'Navidad','slug'=>'navidad','icono'=>'bi-tag','categoria_id'=>6,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>12,'nombre'=>'Halloween','slug'=>'halloween','icono'=>'bi-tag','categoria_id'=>6,'created_at'=>$now,'updated_at'=>$now],
        ]);

        // COLONIAS
        DB::table('colonias')->insert([
            ['id'=>1,'nombre'=>'Centro','cp'=>'97000','created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'nombre'=>'Itzimná','cp'=>'97100','created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'nombre'=>'Montejo','cp'=>'97200','created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'nombre'=>'Francisco de Montejo','cp'=>'97203','created_at'=>$now,'updated_at'=>$now],
        ]);

        // PRODUCTOS (SIN IMAGEN)
        DB::table('productos')->insert([
            ['id'=>1,'nombre'=>'Tacos al Pastor','slug'=>'tacos-al-pastor','descripcion'=>'Tacos tradicionales con piña','precio'=>45,'rating'=>4.6,'icono'=>'bi-basket','subcategoria_id'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>2,'nombre'=>'Tacos de Birria','slug'=>'tacos-birria','descripcion'=>'Tacos con consomé','precio'=>55,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>3,'nombre'=>'Hamburguesa Clásica','slug'=>'hamburguesa-clasica','descripcion'=>'Carne con queso','precio'=>89,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>2,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>4,'nombre'=>'Hamburguesa Doble','slug'=>'hamburguesa-doble','descripcion'=>'Doble carne','precio'=>120,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>2,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>5,'nombre'=>'Pizza Pepperoni','slug'=>'pizza-pepperoni','descripcion'=>'Pizza clásica','precio'=>120,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>3,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>6,'nombre'=>'Pizza Hawaiana','slug'=>'pizza-hawaiana','descripcion'=>'Pizza con piña','precio'=>125,'rating'=>4.5,'icono'=>'bi-basket','subcategoria_id'=>3,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>7,'nombre'=>'Refresco Coca Cola','slug'=>'refresco-coca','descripcion'=>'Refresco clásico','precio'=>25,'rating'=>4.3,'icono'=>'bi-cup','subcategoria_id'=>4,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>8,'nombre'=>'Refresco Sprite','slug'=>'refresco-sprite','descripcion'=>'Refresco de limón','precio'=>25,'rating'=>4.2,'icono'=>'bi-cup','subcategoria_id'=>4,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>9,'nombre'=>'Café Americano','slug'=>'cafe-americano','descripcion'=>'Café negro','precio'=>35,'rating'=>4.6,'icono'=>'bi-cup','subcategoria_id'=>5,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>10,'nombre'=>'Café Latte','slug'=>'cafe-latte','descripcion'=>'Café con leche','precio'=>45,'rating'=>4.8,'icono'=>'bi-cup','subcategoria_id'=>5,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>11,'nombre'=>'Helado Chocolate','slug'=>'helado-chocolate','descripcion'=>'Helado cremoso','precio'=>30,'rating'=>4.7,'icono'=>'bi-cup','subcategoria_id'=>6,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>12,'nombre'=>'Helado Vainilla','slug'=>'helado-vainilla','descripcion'=>'Helado clásico','precio'=>28,'rating'=>4.4,'icono'=>'bi-cup','subcategoria_id'=>6,'created_at'=>$now,'updated_at'=>$now],
            ['id'=>13,'nombre'=>'Pastel de Hallowen','slug'=>'pastel-hallowen','descripcion'=>'Pastel de calabaza','precio'=>150,'rating'=>5,'icono'=>'bi-cup','subcategoria_id'=>12,'created_at'=>$now,'updated_at'=>$now],
        ]);

        // RELACIÓN PRODUCTO-COLONIA
        DB::table('producto_colonia')->insert([
            ['producto_id'=>1,'colonia_id'=>1],
            ['producto_id'=>1,'colonia_id'=>2],
            ['producto_id'=>2,'colonia_id'=>1],
            ['producto_id'=>3,'colonia_id'=>3],
            ['producto_id'=>4,'colonia_id'=>3],
            ['producto_id'=>5,'colonia_id'=>1],
            ['producto_id'=>6,'colonia_id'=>4],
            ['producto_id'=>7,'colonia_id'=>1],
            ['producto_id'=>8,'colonia_id'=>2],
            ['producto_id'=>9,'colonia_id'=>1],
            ['producto_id'=>10,'colonia_id'=>3],
            ['producto_id'=>11,'colonia_id'=>4],
            ['producto_id'=>12,'colonia_id'=>2],
            ['producto_id'=>13,'colonia_id'=>1],
        ]);

        // IMÁGENES
        DB::table('producto_imagen')->insert([
            ['producto_id'=>1,'imagen'=>'tacos1.png'],
            ['producto_id'=>1,'imagen'=>'tacos2.png'],
            ['producto_id'=>1,'imagen'=>'tacos3.png'],
            ['producto_id'=>2,'imagen'=>'birria.png'],
            ['producto_id'=>2,'imagen'=>'birria2.png'],
            ['producto_id'=>3,'imagen'=>'burger1.png'],
            ['producto_id'=>3,'imagen'=>'burger2.png'],
            ['producto_id'=>4,'imagen'=>'burger3.png'],
            ['producto_id'=>5,'imagen'=>'pizza1.png'],
            ['producto_id'=>5,'imagen'=>'pizza2.png'],
            ['producto_id'=>6,'imagen'=>'pizza3.png'],
            ['producto_id'=>7,'imagen'=>'coca.png'],
            ['producto_id'=>8,'imagen'=>'sprite.png'],
            ['producto_id'=>9,'imagen'=>'cafe1.png'],
            ['producto_id'=>10,'imagen'=>'cafe2.png'],
            ['producto_id'=>11,'imagen'=>'helado1.png'],
            ['producto_id'=>12,'imagen'=>'helado2.png'],
            ['producto_id'=>13,'imagen'=>'pastelhallowen.png'],
        ]);
    
    }
}
