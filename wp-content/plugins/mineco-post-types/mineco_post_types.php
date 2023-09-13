<?php
/*
    Plugin Name: Género, Pueblos Indigenas y Personas Con Capacidades Especiales - Post Types
    Plugin URI: https://mineco.gob.gt
    Description: Desarrollo para el Organo de Genero, Pueblos Indigenas y Personas con Capacidades Especiales
    Version: 1.0.0
    Author: Juan José Jolón Granados
    Author URI: https://mineco.gob.gt
    Text Domain: mineco
*/

if(!defined('ABSPATH')) die();

// Registrar Custom Post Type
function mineco_actividades_post_type(): void {
	$labels = array(
		'name'                  => _x( 'Actividades', 'Post Type General Name', 'mineco' ),
		'singular_name'         => _x( 'Actividad', 'Post Type Singular Name', 'mineco' ),
		'menu_name'             => __( 'Actividades', 'mineco' ),
		'name_admin_bar'        => __( 'Actividad', 'mineco' ),
		'archives'              => __( 'Archivo', 'mineco' ),
		'attributes'            => __( 'Atributos', 'mineco' ),
		'parent_item_colon'     => __( 'Actividad Padre', 'mineco' ),
		'all_items'             => __( 'Todas Las Actividades', 'mineco' ),
		'add_new_item'          => __( 'Agregar Actividad', 'mineco' ),
		'add_new'               => __( 'Agregar Actividad', 'mineco' ),
		'new_item'              => __( 'Nueva Actividad', 'mineco' ),
		'edit_item'             => __( 'Editar Actividad', 'mineco' ),
		'update_item'           => __( 'Actualizar Actividad', 'mineco' ),
		'view_item'             => __( 'Ver Actividad', 'mineco' ),
		'view_items'            => __( 'Ver Actividades', 'mineco' ),
		'search_items'          => __( 'Buscar Actividad', 'mineco' ),
		'not_found'             => __( 'No Encontrado', 'mineco' ),
		'not_found_in_trash'    => __( 'No Encontrado en Papelera', 'mineco' ),
		'featured_image'        => __( 'Imagen Destacada', 'mineco' ),
		'set_featured_image'    => __( 'Guardar Imagen destacada', 'mineco' ),
		'remove_featured_image' => __( 'Eliminar Imagen destacada', 'mineco' ),
		'use_featured_image'    => __( 'Utilizar como Imagen Destacada', 'mineco' ),
		'insert_into_item'      => __( 'Insertar en Actividad', 'mineco' ),
		'uploaded_to_this_item' => __( 'Agregado en Actividad', 'mineco' ),
		'items_list'            => __( 'Lista de Actividades', 'mineco' ),
		'items_list_navigation' => __( 'Navegación de Actividades', 'mineco' ),
		'filter_items_list'     => __( 'Filtrar Actividades', 'mineco' ),
	);
	$args = array(
		'label'                 => __( 'Actividad', 'mineco' ),
		'description'           => __( 'Actividades para el Sitio Web', 'mineco' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => true, // true = posts , false = paginas
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'menu_icon'             => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'mineco_Actividades', $args );

}

add_action( 'init', 'mineco_actividades_post_type', 0 );
