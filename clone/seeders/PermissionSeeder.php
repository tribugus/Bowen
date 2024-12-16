<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $list = [

            // Aulas
            ["name" => "showClassrooms", "description" => "Ver Aulas", "module" => "Aulas"],
            ["name" => "createClassrooms", "description" => "Crear Aulas", "module" => "Aulas"],
            ["name" => "updateClassrooms", "description" => "Editar Aulas", "module" => "Aulas"],
            ["name" => "deleteClassrooms", "description" => "Eliminar Aulas", "module" => "Aulas"],

            // Matriculas
            ["name" => "showEnrollments", "description" => "Ver Matriculas", "module" => "Matriculas"],
            ["name" => "createEnrollments", "description" => "Crear Matriculas", "module" => "Matriculas"],
            ["name" => "updateEnrollments", "description" => "Editar Matriculas", "module" => "Matriculas"],
            ["name" => "deleteEnrollments", "description" => "Eliminar Matriculas", "module" => "Matriculas"],

            // Notas
            ["name" => "showGrades", "description" => "Ver Notas", "module" => "Notas"],
            ["name" => "createGrades", "description" => "Crear Notas", "module" => "Notas"],
            ["name" => "updateGrades", "description" => "Editar Notas", "module" => "Notas"],
            ["name" => "deleteGrades", "description" => "Eliminar Notas", "module" => "Notas"],

            // Estudiantes
            ["name" => "showStudents", "description" => "Ver Estudiantes", "module" => "Estudiantes"],
            ["name" => "createStudents", "description" => "Crear Estudiantes", "module" => "Estudiantes"],
            ["name" => "updateStudents", "description" => "Editar Estudiantes", "module" => "Estudiantes"],
            ["name" => "deleteStudents", "description" => "Eliminar Estudiantes", "module" => "Estudiantes"],

            // Asignaturas
            ["name" => "showSubjects", "description" => "Ver Asignaturas", "module" => "Asignaturas"],
            ["name" => "createSubjects", "description" => "Crear Asignaturas", "module" => "Asignaturas"],
            ["name" => "updateSubjects", "description" => "Editar Asignaturas", "module" => "Asignaturas"],
            ["name" => "deleteSubjects", "description" => "Eliminar Asignaturas", "module" => "Asignaturas"],

            // Profesores
            ["name" => "showTeachers", "description" => "Ver Profesores", "module" => "Profesores"],
            ["name" => "createTeachers", "description" => "Crear Profesores", "module" => "Profesores"],
            ["name" => "updateTeachers", "description" => "Editar Profesores", "module" => "Profesores"],
            ["name" => "deleteTeachers", "description" => "Eliminar Profesores", "module" => "Profesores"],

            // Usuarios
            ["name" => "showUsers", "description" => "Ver Usuarios", "module" => "Users"],
            ["name" => "createUsers", "description" => "Crear Usuarios", "module" => "Users"],
            ["name" => "updateUsers", "description" => "Editar Usuarios", "module" => "Users"],
            ["name" => "deleteUsers", "description" => "Eliminar Usuarios", "module" => "Users"],

            // Roles
            ["name" => "showRoles", "description" => "Ver Roles", "module" => "Roles"],
            ["name" => "createRoles", "description" => "Crear Roles", "module" => "Roles"],
            ["name" => "updateRoles", "description" => "Editar Roles", "module" => "Roles"],
            ["name" => "deleteRoles", "description" => "Eliminar Roles", "module" => "Roles"],
        ];
        
        foreach($list as $item) {

            $permission = Permission::where('name', '=', $item['name'])
                                    ->where('module', '=', $item['module'])
                                    ->first();

            if (empty($permission)) {

                $newPermission = new Permission();
                $newPermission->name = $item['name'];
                $newPermission->description = $item['description'];
                $newPermission->module = $item['module'];
                $newPermission->save();
            }
        }
    }
    
}
