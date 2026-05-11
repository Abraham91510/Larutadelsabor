<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Database\Seeders\Administrador\OpcionDashboardSeeder;
use Database\Seeders\Administrador\SubopcionDashboardSeeder;
use Database\Seeders\Administrador\QuienesSomosSeeder;
use Database\Seeders\Administrador\CarruselPaginaPrincipalSeeder;
use Database\Seeders\Administrador\PorqueElegirnosSeeder;
use Database\Seeders\Administrador\BeneficioSeeder;
use Database\Seeders\Administrador\TipoDeServicioSeeder;
use Database\Seeders\Administrador\DatosEmpresaSeeder;
use Database\Seeders\Administrador\RedesSocialesSeeder;
use Database\Seeders\Administrador\EnlacesConoceMasSeeder;

use App\Models\ProductoCaracteristica;
use App\Models\ProductoDetalle;
use App\Models\ProductoStock;
use App\Models\Producto;
use App\Models\TarjetaCliente;

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
    ['id'=>1,'nombre'=>'Comida','slug'=>'comida','icono'=>'bi-basket','created_at'=>$now,'updated_at'=>$now],
    ['id'=>2,'nombre'=>'Bebidas','slug'=>'bebidas','icono'=>'bi-cup','created_at'=>$now,'updated_at'=>$now],
    ['id'=>3,'nombre'=>'Postres','slug'=>'postres','icono'=>'bi-cup-straw','created_at'=>$now,'updated_at'=>$now],
    ['id'=>4,'nombre'=>"Snack’s",'slug'=>'snack','icono'=>'bi-egg-fried','created_at'=>$now,'updated_at'=>$now],
    ['id'=>5,'nombre'=>'Panadería','slug'=>'panaderia','icono'=>'bi-bag','created_at'=>$now,'updated_at'=>$now],
    ['id'=>6,'nombre'=>'Productos de temporada','slug'=>'producto_temporada','icono'=>'bi-calendar-check','created_at'=>$now,'updated_at'=>$now],
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
    ['id'=>1,'nombre'=>'Tacos al Pastor','slug'=>'tacos-al-pastor','descripcion'=>'Tacos tradicionales con piña','precio'=>45,'rating'=>4.6,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>1,'created_at'=>$now,'updated_at'=>$now],

    ['id'=>2,'nombre'=>'Tacos de Birria','slug'=>'tacos-birria','descripcion'=>'Tacos con consomé','precio'=>55,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>1,'created_at'=>$now,'updated_at'=>$now],

    ['id'=>3,'nombre'=>'Hamburguesa Clásica','slug'=>'hamburguesa-clasica','descripcion'=>'Carne con queso','precio'=>89,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>2,'is_destacado'=>1,'created_at'=>$now,'updated_at'=>$now],

    ['id'=>4,'nombre'=>'Hamburguesa Doble','slug'=>'hamburguesa-doble','descripcion'=>'Doble carne','precio'=>120,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>2,'is_destacado'=>1,'created_at'=>$now,'updated_at'=>$now],

    // LOS DEMÁS
    ['id'=>5,'nombre'=>'Pizza Pepperoni','slug'=>'pizza-pepperoni','descripcion'=>'Pizza clásica','precio'=>120,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>3,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>6,'nombre'=>'Pizza Hawaiana','slug'=>'pizza-hawaiana','descripcion'=>'Pizza con piña','precio'=>125,'rating'=>4.5,'icono'=>'bi-basket','subcategoria_id'=>3,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>7,'nombre'=>'Refresco Coca Cola','slug'=>'refresco-coca','descripcion'=>'Refresco clásico','precio'=>25,'rating'=>4.3,'icono'=>'bi-cup','subcategoria_id'=>4,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>8,'nombre'=>'Refresco Sprite','slug'=>'refresco-sprite','descripcion'=>'Refresco de limón','precio'=>25,'rating'=>4.2,'icono'=>'bi-cup','subcategoria_id'=>4,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>9,'nombre'=>'Café Americano','slug'=>'cafe-americano','descripcion'=>'Café negro','precio'=>35,'rating'=>4.6,'icono'=>'bi-cup','subcategoria_id'=>5,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>10,'nombre'=>'Café Latte','slug'=>'cafe-latte','descripcion'=>'Café con leche','precio'=>45,'rating'=>4.8,'icono'=>'bi-cup','subcategoria_id'=>5,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>11,'nombre'=>'Helado Chocolate','slug'=>'helado-chocolate','descripcion'=>'Helado cremoso','precio'=>30,'rating'=>4.7,'icono'=>'bi-cup','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>12,'nombre'=>'Helado Vainilla','slug'=>'helado-vainilla','descripcion'=>'Helado clásico','precio'=>28,'rating'=>4.4,'icono'=>'bi-cup','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>13,'nombre'=>'Pastel de Hallowen','slug'=>'pastel-hallowen','descripcion'=>'Pastel de calabaza','precio'=>150,'rating'=>5,'icono'=>'bi-cup','subcategoria_id'=>12,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    ['id'=>14,'nombre'=>'Pastel de San Valentín','slug'=>'pastel-san-valentin','descripcion'=>'Pastel especial romántico','precio'=>180,'rating'=>4.9,'icono'=>'bi-cake','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>15,'nombre'=>'Cheesecake Fresa','slug'=>'cheesecake-fresa','descripcion'=>'Postre cremoso de fresa','precio'=>95,'rating'=>4.7,'icono'=>'bi-cake','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>16,'nombre'=>'Brownie Chocolate','slug'=>'brownie-chocolate','descripcion'=>'Brownie casero','precio'=>70,'rating'=>4.6,'icono'=>'bi-cake','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    // 🍟 SNACKS (5)
    ['id'=>17,'nombre'=>'Papas Especiales','slug'=>'papas-especiales','descripcion'=>'Papas con aderezo','precio'=>45,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>7,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>18,'nombre'=>'Nachos Supremos','slug'=>'nachos-supremos','descripcion'=>'Nachos con queso','precio'=>60,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>7,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>19,'nombre'=>'Palomitas Mantequilla','slug'=>'palomitas-mantequilla','descripcion'=>'Palomitas clásicas','precio'=>35,'rating'=>4.3,'icono'=>'bi-basket','subcategoria_id'=>7,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>20,'nombre'=>'Chicharrones','slug'=>'chicharrones','descripcion'=>'Chicharrón crujiente','precio'=>50,'rating'=>4.5,'icono'=>'bi-basket','subcategoria_id'=>7,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>21,'nombre'=>'Mix Botanero','slug'=>'mix-botanero','descripcion'=>'Snack mixto','precio'=>55,'rating'=>4.6,'icono'=>'bi-basket','subcategoria_id'=>7,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    // 🥐 PANADERÍA (5)
    ['id'=>22,'nombre'=>'Concha Tradicional','slug'=>'concha-tradicional','descripcion'=>'Pan dulce clásico','precio'=>18,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>9,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>23,'nombre'=>'Cuernito de Mantequilla','slug'=>'cuernito-mantequilla','descripcion'=>'Pan suave','precio'=>22,'rating'=>4.5,'icono'=>'bi-basket','subcategoria_id'=>9,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>24,'nombre'=>'Donas Glaseadas','slug'=>'donas-glaseadas','descripcion'=>'Donas dulces','precio'=>25,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>9,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>25,'nombre'=>'Bollo Dulce','slug'=>'bollo-dulce','descripcion'=>'Bollo casero','precio'=>20,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>9,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>26,'nombre'=>'Roles de Canela','slug'=>'roles-canela','descripcion'=>'Pan con canela','precio'=>30,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>9,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    // 🎉 TEMPORADA (4)
    ['id'=>27,'nombre'=>'Galletas Navideñas','slug'=>'galletas-navidad','descripcion'=>'Edición navideña','precio'=>40,'rating'=>4.8,'icono'=>'bi-gift','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>28,'nombre'=>'Pastel Halloween','slug'=>'pastel-halloween','descripcion'=>'Edición Halloween','precio'=>150,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>12,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>29,'nombre'=>'Pan de Muerto Especial','slug'=>'pan-muerto','descripcion'=>'Tradicional mexicano','precio'=>35,'rating'=>5.0,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],
    ['id'=>30,'nombre'=>'Rosca de Reyes','slug'=>'rosca-reyes','descripcion'=>'Temporada enero','precio'=>120,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    // 🥤 BEBIDA (1)
    ['id'=>31,'nombre'=>'Agua Fresca Jamaica','slug'=>'agua-jamaica','descripcion'=>'Bebida natural','precio'=>20,'rating'=>4.5,'icono'=>'bi-cup','subcategoria_id'=>4,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

    ['id'=>32,'nombre'=>'Torta de Jamón','slug'=>'torta-jamon','descripcion'=>'Torta clásica mexicana','precio'=>40,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>2,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>33,'nombre'=>'Torta de Milanesa','slug'=>'torta-milanesa','descripcion'=>'Torta con milanesa crujiente','precio'=>55,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>2,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>34,'nombre'=>'Hot Dog Especial','slug'=>'hot-dog-especial','descripcion'=>'Hot dog con tocino y aderezos','precio'=>35,'rating'=>4.3,'icono'=>'bi-basket','subcategoria_id'=>2,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>35,'nombre'=>'Quesadillas de Queso','slug'=>'quesadillas-queso','descripcion'=>'Tortilla con queso fundido','precio'=>30,'rating'=>4.6,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>36,'nombre'=>'Quesadillas de Pollo','slug'=>'quesadillas-pollo','descripcion'=>'Quesadillas con pollo deshebrado','precio'=>45,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>37,'nombre'=>'Enchiladas Verdes','slug'=>'enchiladas-verdes','descripcion'=>'Enchiladas con salsa verde','precio'=>70,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>38,'nombre'=>'Enchiladas Rojas','slug'=>'enchiladas-rojas','descripcion'=>'Enchiladas con salsa roja','precio'=>70,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>39,'nombre'=>'Sopa de Tortilla','slug'=>'sopa-tortilla','descripcion'=>'Sopa tradicional mexicana','precio'=>60,'rating'=>4.6,'icono'=>'bi-cup','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>40,'nombre'=>'Arroz con Pollo','slug'=>'arroz-pollo','descripcion'=>'Arroz sazonado con pollo','precio'=>75,'rating'=>4.5,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>41,'nombre'=>'Flautas Doradas','slug'=>'flautas-doradas','descripcion'=>'Flautas crujientes con crema','precio'=>65,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>42,'nombre'=>'Molletes','slug'=>'molletes','descripcion'=>'Pan con frijoles y queso','precio'=>45,'rating'=>4.4,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>43,'nombre'=>'Chilaquiles Verdes','slug'=>'chilaquiles-verdes','descripcion'=>'Totopos con salsa verde','precio'=>55,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>44,'nombre'=>'Chilaquiles Rojos','slug'=>'chilaquiles-rojos','descripcion'=>'Totopos con salsa roja','precio'=>55,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>45,'nombre'=>'Mole Poblano','slug'=>'mole-poblano','descripcion'=>'Pollo con mole tradicional','precio'=>90,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>46,'nombre'=>'Pozole Rojo','slug'=>'pozole-rojo','descripcion'=>'Pozole tradicional mexicano','precio'=>85,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>47,'nombre'=>'Pozole Blanco','slug'=>'pozole-blanco','descripcion'=>'Pozole suave tradicional','precio'=>85,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>48,'nombre'=>'Tostadas de Tinga','slug'=>'tostadas-tinga','descripcion'=>'Tostadas con pollo en chipotle','precio'=>40,'rating'=>4.6,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>49,'nombre'=>'Tostadas de Ceviche','slug'=>'tostadas-ceviche','descripcion'=>'Tostadas de pescado fresco','precio'=>60,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>50,'nombre'=>'Camarones Empanizados','slug'=>'camarones-empanizados','descripcion'=>'Camarones crujientes','precio'=>120,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>51,'nombre'=>'Pescado Frito','slug'=>'pescado-frito','descripcion'=>'Pescado entero frito','precio'=>130,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>1,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>72,'nombre'=>'Pan de Muerto Tradicional','slug'=>'pan-de-muerto-tradicional','descripcion'=>'Pan de muerto clásico mexicano','precio'=>35,'rating'=>5.0,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>73,'nombre'=>'Pan de Muerto Relleno de Nata','slug'=>'pan-de-muerto-nata','descripcion'=>'Pan de muerto con relleno cremoso','precio'=>45,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>74,'nombre'=>'Rosca de Reyes Tradicional','slug'=>'rosca-de-reyes-tradicional','descripcion'=>'Rosca clásica de temporada','precio'=>120,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>75,'nombre'=>'Rosca de Reyes con Relleno','slug'=>'rosca-de-reyes-relleno','descripcion'=>'Rosca rellena de crema o chocolate','precio'=>150,'rating'=>5.0,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>76,'nombre'=>'Galletas Navideñas de Jengibre','slug'=>'galletas-jengibre-navidad','descripcion'=>'Galletas especiadas navideñas','precio'=>40,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>77,'nombre'=>'Galletas de Navidad Decoradas','slug'=>'galletas-navidad-decoradas','descripcion'=>'Galletas con glaseado festivo','precio'=>45,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>78,'nombre'=>'Chocolate Caliente Navideño','slug'=>'chocolate-navideno','descripcion'=>'Chocolate espeso de temporada','precio'=>38,'rating'=>4.8,'icono'=>'bi-cup','subcategoria_id'=>5,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>79,'nombre'=>'Ponche Navideño','slug'=>'ponche-navideno','descripcion'=>'Bebida caliente tradicional','precio'=>30,'rating'=>4.9,'icono'=>'bi-cup','subcategoria_id'=>4,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>80,'nombre'=>'Tamales de Dulce','slug'=>'tamales-dulce','descripcion'=>'Tamales dulces de temporada','precio'=>25,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>81,'nombre'=>'Tamales de Verde','slug'=>'tamales-verde','descripcion'=>'Tamales de salsa verde','precio'=>30,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>82,'nombre'=>'Tamales de Rojo','slug'=>'tamales-rojo','descripcion'=>'Tamales de salsa roja','precio'=>30,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>83,'nombre'=>'Buñuelos de Viento','slug'=>'bunuelos-de-viento','descripcion'=>'Postre crujiente con azúcar','precio'=>20,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>84,'nombre'=>'Chocolate Abuelita Caliente','slug'=>'chocolate-abuelita-caliente','descripcion'=>'Chocolate tradicional mexicano','precio'=>35,'rating'=>4.9,'icono'=>'bi-cup','subcategoria_id'=>5,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>85,'nombre'=>'Panettone Navideño','slug'=>'panettone-navideno','descripcion'=>'Pan dulce estilo italiano','precio'=>90,'rating'=>4.8,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>86,'nombre'=>'Strudel de Manzana','slug'=>'strudel-manzana','descripcion'=>'Postre de manzana y canela','precio'=>85,'rating'=>4.7,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>87,'nombre'=>'Pastel de Zanahoria','slug'=>'pastel-zanahoria','descripcion'=>'Pastel esponjoso con crema','precio'=>95,'rating'=>4.9,'icono'=>'bi-cake','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>88,'nombre'=>'Pastel de Chocolate Navideño','slug'=>'pastel-chocolate-navidad','descripcion'=>'Pastel especial de temporada','precio'=>120,'rating'=>5.0,'icono'=>'bi-cake','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>89,'nombre'=>'Helado de Rompope','slug'=>'helado-rompope','descripcion'=>'Helado sabor rompope','precio'=>50,'rating'=>4.8,'icono'=>'bi-cup','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>90,'nombre'=>'Fresas con Crema Navideñas','slug'=>'fresas-crema-navidad','descripcion'=>'Postre frío de temporada','precio'=>55,'rating'=>4.7,'icono'=>'bi-cup','subcategoria_id'=>6,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],

['id'=>91,'nombre'=>'Churros con Chocolate','slug'=>'churros-chocolate','descripcion'=>'Churros tradicionales con salsa','precio'=>45,'rating'=>4.9,'icono'=>'bi-basket','subcategoria_id'=>11,'is_destacado'=>0,'created_at'=>$now,'updated_at'=>$now],









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
            ['producto_id'=>14,'imagen'=>'pastel-san-valentin.png'],
    ['producto_id'=>15,'imagen'=>'cheesecake-fresa.png'],
    ['producto_id'=>16,'imagen'=>'brownie-chocolate.png'],

    ['producto_id'=>17,'imagen'=>'papas-especiales.png'],
    ['producto_id'=>18,'imagen'=>'nachos-supremos.png'],
    ['producto_id'=>19,'imagen'=>'palomitas-mantequilla.png'],
    ['producto_id'=>20,'imagen'=>'chicharrones.png'],
    ['producto_id'=>21,'imagen'=>'mix-botanero.png'],

    ['producto_id'=>22,'imagen'=>'concha-tradicional.png'],
    ['producto_id'=>23,'imagen'=>'cuernito-mantequilla.png'],
    ['producto_id'=>24,'imagen'=>'donas-glaseadas.png'],
    ['producto_id'=>25,'imagen'=>'bollo-dulce.png'],
    ['producto_id'=>26,'imagen'=>'roles-canela.png'],

    ['producto_id'=>27,'imagen'=>'galletas-navidad.png'],
    ['producto_id'=>28,'imagen'=>'pastel-halloween.png'],
    ['producto_id'=>29,'imagen'=>'pan-muerto.png'],
    ['producto_id'=>30,'imagen'=>'rosca-reyes.png'],

    ['producto_id'=>31,'imagen'=>'agua-jamaica.png'],
        ]);

DB::table('opciones_menu')->insert([
    [
        'id'=>1,
        'nombre'=>'Inicio',
        'slug'=>'inicio',
        'url'=>'/plataforma/inicio',
        'roles'=>'cliente,comerciante',
        'orden'=>0,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    [
        'id'=>2,
        'nombre'=>'Categorías',
        'slug'=>'categorias',
        'url'=>'#',
        'roles'=>'cliente,comerciante',
        'orden'=>1,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    [
        'id'=>3,
        'nombre'=>'Comerciantes',
        'slug'=>'comerciantes',
        'url'=>'#',
        'roles'=>'cliente,comerciante',
        'orden'=>2,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    [
        'id'=>4,
        'nombre'=>'Comentarios',
        'slug'=>'comentarios',
        'url'=>'/plataforma/comentarios',
        'roles'=>'cliente',
        'orden'=>3,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

[
        'id'=>5,
        'nombre'=>'Carrito',
        'slug'=>'carrito',
        'url'=>'/plataforma/carrito',
        'roles'=>'cliente',
        'orden'=>4,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    [
        'id'=>6,
        'nombre'=>'Mis pedidos',
        'slug'=>'mis-pedidos',
        'url'=>'/plataforma/mis-pedidos',
        'roles'=>'cliente',
        'orden'=>5,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    [
        'id'=>7,
        'nombre'=>'Tarjeta',
        'slug'=>'tarjeta',
        'url'=>'/plataforma/tarjeta',
        'roles'=>'cliente',
        'orden'=>6,
        'created_at'=>$now,
        'updated_at'=>$now
    ],


]);

DB::table('subopciones_menu')->insert([

    // Comerciantes
    [
        'opcion_id'=>3,
        'nombre'=>'Cerca de mí',
        'url'=>'/plataforma/cerca_mi',
        'icono'=>'bi-geo-alt',
        'roles'=>'cliente,comerciante',
        'orden'=>1,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>3,
        'nombre'=>'Mejor calificados',
        'url'=>'/plataforma/mejor_calificados',
        'icono'=>'bi-star',
        'roles'=>'cliente,comerciante',
        'orden'=>2,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>3,
        'nombre'=>'Nuevos',
        'url'=>'/plataforma/nuevos_comerciantes',
        'icono'=>'bi-plus-circle',
        'roles'=>'cliente,comerciante',
        'orden'=>3,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    // Aprende
    [
        'opcion_id'=>2,
        'nombre'=>'Clientes',
        'url'=>'/plataforma/clientes',
        'icono'=>'bi-person',
        'roles'=>'cliente,comerciante',
        'orden'=>1,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>2,
        'nombre'=>'Comerciantes',
        'url'=>'/plataforma/comerciantes',
        'icono'=>'bi-shop',
        'roles'=>'cliente,comerciante',
        'orden'=>2,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>2,
        'nombre'=>'Pagos',
        'url'=>'/plataforma/pagos',
        'icono'=>'bi-credit-card',
        'roles'=>'cliente,comerciante',
        'orden'=>3,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

// 🛒 Carrito
    [
        'opcion_id'=>5,
        'nombre'=>'Ver carrito',
        'url'=>'/plataforma/carrito',
        'icono'=>'bi-cart',
        'roles'=>'cliente',
        'orden'=>4,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>5,
        'nombre'=>'Aplicar cupón',
        'url'=>'/plataforma/carrito',
        'icono'=>'bi-ticket-perforated',
        'roles'=>'cliente',
        'orden'=>5,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    // 📦 Pedidos
    [
        'opcion_id'=>6,
        'nombre'=>'Mis pedidos',
        'url'=>'/plataforma/mis-pedidos',
        'icono'=>'bi-receipt',
        'roles'=>'cliente',
        'orden'=>6,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>6,
        'nombre'=>'Ver QR pedido',
        'url'=>'/plataforma/mis-pedidos',
        'icono'=>'bi-qr-code',
        'roles'=>'cliente',
        'orden'=>7,
        'created_at'=>$now,
        'updated_at'=>$now
    ],

    // 💳 Tarjeta
    [
        'opcion_id'=>7,
        'nombre'=>'Mi tarjeta',
        'url'=>'/plataforma/tarjeta',
        'icono'=>'bi-credit-card',
        'roles'=>'cliente',
        'orden'=>8,
        'created_at'=>$now,
        'updated_at'=>$now
    ],
    [
        'opcion_id'=>7,
        'nombre'=>'Recargar saldo',
        'url'=>'/plataforma/tarjeta',
        'icono'=>'bi-plus-circle',
        'roles'=>'cliente',
        'orden'=>9,
        'created_at'=>$now,
        'updated_at'=>$now
    ],



]);



DB::table('tarjetas_cliente')->insert([

[
    'cliente_id'=>1,
    'titular'=>'Carlos Ojeda',
    'numero'=>'4111111111111111',
    'cvv'=>'123',
    'expiracion'=>'12/29',
    'saldo'=>5000
],

[
    'cliente_id'=>2,
    'titular'=>'Cliente Demo',
    'numero'=>'5555555555554444',
    'cvv'=>'456',
    'expiracion'=>'11/28',
    'saldo'=>50
]

]);

$this->call([
    OpcionDashboardSeeder::class,
    SubopcionDashboardSeeder::class,
     QuienesSomosSeeder::class,
     CarruselPaginaPrincipalSeeder::class,
     PorqueElegirnosSeeder::class,
     BeneficioSeeder::class,
     TipoDeServicioSeeder::class,
     DatosEmpresaSeeder::class,
     RedesSocialesSeeder::class,
     EnlacesConoceMasSeeder::class,
]);

foreach (Producto::all() as $producto) {

            ProductoCaracteristica::insert([
                ['producto_id'=>$producto->id,'nombre'=>'Color','descripcion'=>'Rojo'],
                ['producto_id'=>$producto->id,'nombre'=>'Peso','descripcion'=>'250g'],
                ['producto_id'=>$producto->id,'nombre'=>'Origen','descripcion'=>'Artesanal']
            ]);

            ProductoDetalle::create([
                'producto_id'=>$producto->id,
                'descripcion'=>'Producto premium',
                'ingredientes'=>'Carne, pan',
                'nutricional'=>'500 kcal',
                'advertencias'=>'Contiene gluten'
            ]);

            ProductoStock::create([
                'producto_id'=>$producto->id,
                'stock'=>20
            ]);
        }

        DB::table('cupones')->insert([
            ['codigo'=>'NUEVO26','descuento'=>20,'tipo'=>'porcentaje'],
            ['codigo'=>'BBQ10','descuento'=>10,'tipo'=>'fijo']
        ]);



    }




    
    

    
}
