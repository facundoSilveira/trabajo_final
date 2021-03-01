<?php

use App\Accesorio;
use App\Cliente;
use App\Configuracion;
use App\Direccion;
use App\Equipo;
use App\Estado;
use App\Marca;
use App\MarcaRecurso;
use App\Medida;
use App\Modelo;
use App\Prioridad;
use App\Proveedor;
use App\Recurso;
use App\Servicio;
use App\TipoEquipo;
use App\TipoRecurso;
use App\TipoServicio;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Caffeinated\Shinobi\Models\Permission;

class GenerarSeed extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {

        Direccion::create([
            'calle' => 'Las heras',
            'altura' => 5,
        ]);
        Proveedor::create([
            'nombre' => 'Manolo SA',
            'telefono' => '375822123',
            'cuit' => '20-233122332-2',
            'email' => 'manolo@sa.com',
            'direc_postal' => 'Barrio manolo City',
            'direccion_id' => 1,
        ]);
        Cliente::create([
            'nombre' => 'Manolo',
            'dni' => '40123323',
            'apellido' => 'Sanches',
            'telefono' => '3232312',
            'email' => 'mano@lio.com',
            'direccion_id' => 1,
        ]);

        Marca::create([
            'descripcion' => 'Acer',
        ]);
        Marca::create([
            'descripcion' => 'Samsung',
        ]);
        Marca::create([
            'descripcion' => 'Hewlett-Packard',
        ]);
        MarcaRecurso::create([
            'nombre' => 'Kingston',
        ]);
        MarcaRecurso::create([
            'nombre' => 'SeaGate',
        ]);
        MarcaRecurso::create([
            'nombre' => 'Intel',
        ]);
        MarcaRecurso::create([
            'nombre' => 'AMD',
        ]);
        MarcaRecurso::create([
            'nombre' => 'AORUS',
        ]);
        MarcaRecurso::create([
            'nombre' => 'Asus',
        ]);
        TipoEquipo::create([
            'nombre' => 'Notebook',
        ]);
        Equipo::create([
            'foto' => 'images/1602136808PCshop.jpg',
            'nroSerie' => '33221aA212',
            'detallesGenerales' => 'No prende',
            'cliente_id' => 1,
            'marca_id' => 1,
            'tipo_equipo_id' => 1,
        ]);
        Prioridad::create([
            'nombre' => 'Alta'
        ]);
        Prioridad::create([
            'nombre' => 'Media'
        ]);
        Prioridad::create([
            'nombre' => 'Baja'
        ]);
        TipoServicio::create([
            'nombre' => 'Cambio de Componente',
            'descripcion' => 'En este tipo de servicio se realiza un cambio de componente Hardware',
            'precio' => 1200
        ]);
        TipoServicio::create([
            'nombre' => 'Instalacion de S.O.',
            'descripcion' => 'En este tipo de servicio se realiza una instalacion de Sistema Operativo',
            'precio' => 1500
        ]);
        Medida::create([
            'nombre' => 'GB',
        ]);
        Medida::create([
            'nombre' => 'MB',
        ]);
        Medida::create([
            'nombre' => 'Pulgada',
        ]);
        TipoRecurso::create([
            'nombre' => 'Memoria RAM',
            'descripcion' => 'Este tipo de recurso representa a la memoria de acceso aleatorio del dispositivo',
        ]);
        TipoRecurso::create([
            'nombre' => 'Disco',
            'descripcion' => 'Este tipo de recurso representa a la memoria de almacenamiento',
        ]);
        Modelo::create([
            'nombre' => 'DDR3',
            'tipo_recurso_id' => 1
        ]);
        Modelo::create([
            'nombre' => 'DDR4',
            'tipo_recurso_id' => 1
        ]);
        Modelo::create([
            'nombre' => 'SDD',
            'tipo_recurso_id' => 2
        ]);
        Modelo::create([
            'nombre' => 'HDD',
            'tipo_recurso_id' => 2
        ]);
        Modelo::create([
            'nombre' => 'NVMe.2',
            'tipo_recurso_id' => 2
        ]);
        Recurso::create([
            'stock' => 0,
            'stockMinimo' => 5,
            'nroSerie' => '2332aaa2w',
            'tamaño' => 4,
            'precio' => 2300,
            'medida_id' => 1,
            'marca_recurso_id' => 1,
            'tipo_recurso_id' => 1,
            'modelo_id' => 1,
        ]);
        Recurso::create([
            'stock' => 0,
            'stockMinimo' => 5,
            'nroSerie' => '2332aaa2w',
            'tamaño' => 8,
            'precio' => 2300,
            'medida_id' => 1,
            'marca_recurso_id' => 1,
            'tipo_recurso_id' => 1,
            'modelo_id' => 1,
        ]);
        Recurso::create([
            'stock' => 0,
            'stockMinimo' => 5,
            'nroSerie' => '2332aaa2w',
            'tamaño' => 4,
            'precio' => 2300,
            'medida_id' => 1,
            'marca_recurso_id' => 1,
            'tipo_recurso_id' => 1,
            'modelo_id' => 2,
        ]);
        Recurso::create([
            'stock' => 0,
            'stockMinimo' => 5,
            'nroSerie' => '2332aaa2w',
            'tamaño' => 500,
            'precio' => 2300,
            'medida_id' => 1,
            'marca_recurso_id' => 2,
            'tipo_recurso_id' => 2,
            'modelo_id' => 4,
        ]);
        Accesorio::create([
            'descripcion' => 'teclado'
        ]);
        Accesorio::create([
            'descripcion' => 'cargador'
        ]);
        Accesorio::create([
            'descripcion' => 'mouse'
        ]);
        Estado::create([
            'nombre' => 'Pendiente'
        ]);
        Estado::create([
            'nombre' => 'En Revision'
        ]);
        Estado::create([
            'nombre' => 'En Espera'
        ]);
        Estado::create([
            'nombre' => 'Confirmado'
        ]);
        Estado::create([
            'nombre' => 'En Proceso'
        ]);
        Estado::create([
            'nombre' => 'Finalizado'
        ]);
        Estado::create([
            'nombre' => 'Cancelado'
        ]);
        Estado::create([
            'nombre' => 'Entregado'
        ]);
        Configuracion::create([
            'nombre' => 'PC Shop',
            'direccion' => 'Andresito 456',
            'telefono' => '3758529538',
            'email' => 'pcshopapostoles@gmail.com' ,
            'logo' => '1606918123computadora-completa-amd-a4-3ghz-monitor-led-hd-156-video-hdmi.jpg'
        ]);

        $administrador = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12346789') ,
        ]);


        $tecnico = User::create([
            'name' => 'rober',
            'email' => 'tecnico@tecnico.com',
            'password' => Hash::make('12346789') ,
        ]);

        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'ADMIN',
            'description' => 'Super usuario del sistema',
            'special' => 'all-access'
        ]);
        $tecnicoRole = Role::create([
            'name' => 'Tecnico',
            'slug' => 'TECNICO',
            'description' => 'Tecnico Reparador del sistema',
        ]);
        $permisoAdmin = Permission::create([
            'name' => 'Permiso Admin',
            'slug' => 'PERM.ADMIN',
            'description' => 'Permiso de administrado del sistema',
        ]);
        $perisoTecnico = Permission::create([
            'name' => 'Permiso Tecnico',
            'slug' => 'PERM.TECNICO',
            'description' => 'Permiso de tecnico del sistema',
        ]);

        $adminRole->syncPermissions('PERM.ADMIN');
        $tecnicoRole->syncPermissions('PERM.TECNICO');

        $administrador->assignRoles('ADMIN');
        $tecnico->assignRoles('TECNICO');
    }

}
