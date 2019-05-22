<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * French translations of application's texts
 *
 * @author      Didier Viret
 * @link        https://github.com/OrifInformatique/ci_pack_base
 * @copyright   Copyright (c), Orif <http://www.orif.ch>
 */

// Application name
$lang['app_title']                      = 'Gestion de formations';
$lang['app_welcome']                    = 'Bienvenue sur le logiciel de gestion de formations.';

// Navigation menu
$lang['nav_categories']                 = 'Catégories:';
$lang['nav_group']                      = 'Groupes';
$lang['nav_module']                     = 'Modules';
$lang['nav_apprentice']                 = 'Apprentis';
$lang['nav_formation']                  = 'Formations';
$lang['nav_admin_users']                = 'Utilisateurs';
$lang['nav_admin_user_types']           = 'Types d\'utilisateur';
$lang['nav_admin_teachers']             = 'MSPs';

// Page titles
$lang['page_prefix']                    = 'Gestion formations';

// Date and time formats
$lang['date_format_short']              = 'd.m.Y';
$lang['datetime_format_short']          = 'd.m.Y H:i';

// Fields labels
$lang['field_username']                 = 'Nom d\'utilisateur:';
$lang['field_password']                 = 'Mot de passe:';
$lang['group_name']                     = 'Nom';
$lang['group_weight']                   = 'Poids';
$lang['group_eliminatory']              = 'Eliminatoire';
$lang['group_position']                 = 'Position';
$lang['group_parent_group']             = 'Groupe Parent';
$lang['module_number']                  = 'Numéro de module';
$lang['module_title']                   = 'Titre';
$lang['module_group']                   = 'Groupe';
$lang['module_description']             = 'Description';
$lang['module_is_subject']              = 'Matière';
$lang['apprentice_firstname']           = 'Prénom';
$lang['apprentice_lastname']            = 'Nom';
$lang['apprentice_datebirth']           = 'Date de naissance';
$lang['apprentice_formation']           = 'Formation';
$lang['apprentice_teacher']             = 'MSP';
$lang['apprentice_user']                = 'Utilisateur';
$lang['formation_name']                 = 'Nom';
$lang['formation_duration']             = 'Durée';
$lang['user_create']                    = 'Nouvel utilisateur';
$lang['user_username']                  = 'Nom d\'utilisateur';
$lang['user_password']                  = 'Mot de passe';
$lang['user_password_again']            = 'Répétez le mot de passe';
$lang['user_type']                      = 'Type d\'utilisateur';
$lang['user_type_type']                 = 'Type d\'utilisateur';
$lang['user_type_access']               = 'Niveau d\'accès';
$lang['teacher_name']                   = 'Nom';
$lang['teacher_firstname']              = 'Prénom';
$lang['teacher_username']               = 'Nom d\'utilisateur';

// Log Error
$lang['invalid_id']                     = 'Ces informations de connexion ne sont pas valides';
$lang['no_id']                          = 'Veuillez insérer des identifiants';

// List headers
$lang['group_list']                     = 'Liste des groupes';
$lang['group_new']                      = 'Nouveau groupe';
$lang['group_modify']                   = 'Modifier le groupe';
$lang['group_delete']                   = 'Supprimer le groupe';
$lang['group_delete_not']               = 'Le groupe ne peut pas être supprimé car un autre groupe y est associé.';
$lang['group_add_module']               = 'Ajouter un module à ';
$lang['module_list']                    = 'Liste des modules';
$lang['module_new']                     = 'Nouveau module';
$lang['module_new_not']                 = 'Impossible de créer un module car il n\'y a aucun groupe existant.';
$lang['module_modify']                  = 'Modifier le module';
$lang['module_delete']                  = 'Supprimer le module';
$lang['module_delete_not']              = 'Le module ne peut pas être supprimé car un groupe y est associée.';
$lang['apprentice_list']                = 'Liste des apprentis';
$lang['apprentice_new']                 = 'Nouvel apprenti';
$lang['apprentice_modify']              = 'Modifier l\'apprenti';
$lang['apprentice_delete']              = 'Supprimer l\'apprenti';
$lang['formation_list']                 = 'Liste des formations';
$lang['formation_new']                  = 'Nouvelle formation';
$lang['formation_modify']               = 'Modifier la formation';
$lang['formation_delete']               = 'Supprimer la formation';
$lang['formation_delete_not']           = 'La formation ne peut pas être supprimée car un module y est associé.';
$lang['admin_menu']                     = 'Menus d\'administration';
$lang['user_list']                      = 'Liste des utilisateurs';
$lang['user_new']                       = 'Nouvel utilisateur';
$lang['user_modify']                    = 'Modifer l\'utilisateur';
$lang['user_delete']                    = 'Supprimer l\'utilisateur';
$lang['user_delete_not']                = 'L\'utilisateur ne peut pas être supprimé car une personne y est associée';
$lang['user_change_password']           = 'Modifier le mot de passe';
$lang['user_password_old']              = 'Mot de passe précédent';
$lang['user_password_new']              = 'Nouveau mot de passe';
$lang['user_type_list']                 = 'Liste des types d\'utilisateur';
$lang['user_type_new']                  = 'Nouveau type d\'utilisateur';
$lang['user_type_modify']               = 'Modfier le type d\'utilsateur';
$lang['user_type_delete']               = 'Supprimer le type d\'utilisateur';
$lang['user_type_delete_not']           = 'Le type d\'utilisateur ne peut pas être supprimé car un utilisateur y est associé';
$lang['teacher_new']                    = 'Nouveau MSP';
$lang['teacher_modify']                 = 'Modifier le MSP';
$lang['teacher_delete']                 = 'Supprimer le MSP';
$lang['teacher_delete_not']             = 'Le MSP ne peut pas être supprimé car un apprenti y est associé';

// Buttons
$lang['btn_login']                      = 'Se connecter';
$lang['btn_logout']                     = 'Se déconnecter';
$lang['btn_admin']                      = 'Administration';
$lang['btn_submit']                     = 'Envoyer';
$lang['btn_reset']                      = 'Réinitialiser';
$lang['yes']                            = 'Oui';
$lang['no']                             = 'Non';
$lang['none']                           = 'Aucun';
$lang['none_f']                         = 'Aucune';
$lang['save']                           = 'Enregistrer';
$lang['quit']                           = 'Fermer';
$lang['save_quit']                      = 'Enregistrer et fermer';
$lang['cancel']                         = 'Annuler';
$lang['return']                         = 'Retour';
$lang['formation_edit_module']          = 'Éditer les modules de la formation';

// Messages
$lang['group_delete_confirm']           = 'Etes-vous sûr de vouloir supprimer le groupe';
$lang['group_deleted']                  = 'Le groupe a été supprimé';
$lang['module_delete_confirm']          = 'Etes-vous sûr de vouloir supprimer le module';
$lang['module_deleted']                 = 'Le module a été supprimé';
$lang['apprentice_delete_confirm']      = 'Etes-vous sûr de vouloir supprimer l\'apprenti';
$lang['apprentice_deleted']             = 'L\'apprenti a été supprimé';
$lang['formation_delete_confirm']       = 'Etes-vous sûr de vouloir supprimer la formation';
$lang['formation_deleted']              = 'La formation a été supprimé';
$lang['user_delete_confirm']            = 'Etes-vous sûr de vouloir supprimer l\'utilisateur';
$lang['user_deleted']                   = 'L\'utilisateur a été supprimé';
$lang['user_type_delete_confirm']       = 'Etes-vous sûr de vouloir supprimer le type d\'utilisateur';
$lang['user_type_deleted']              = 'Le type d\'utilisateur a été supprimé';
$lang['teacher_delete_confirm']         = 'Etes-vous sûr de vouloir supprimé le MSP';
$lang['teacher_deleted']                = 'Le MSP a été supprimé';

// Errors
$lang['group_missing']                  = 'Aucun groupe trouvé avec les paramètres entrés';
$lang['module_missing']                 = 'Aucun module trouvé avec les paramètres entrés';
$lang['apprentice_missing']             = 'Aucun apprenti trouvé avec les paramètres entrés';
$lang['formation_missing']              = 'Aucune formation trouvée avec les paramètres entrés';
$lang['user_missing']                   = 'Aucun utilisateur trouvé avec les paramètres entrés';
$lang['user_type_missing']              = 'Aucun type d\'utilisateur trouvé avec les paramètres entrés';
$lang['teacher_missing']                = 'Aucun MSP trouvé avec les paramètres entrés';
$lang['subject']                        = 'Matière';

// Duallistbox
$lang['duallistbox_text_clear']         = 'Tout montrer';
$lang['duallistbox_place_holder']       = 'Filtrer';
$lang['duallistbox_info_text']          = 'Montrant tout les';
$lang['duallistbox_info_text_empty']    = 'Aucune option disponible';

$lang['duallistbox_modules_selected']   = 'Modules sélectionnés';
$lang['duallistbox_modules_not_selected']   = 'Modules non sélectionnés';

// Other texts
$lang['redirect_warn_start']            = 'Vous allez être redirigé dans';
$lang['redirect_warn_end']              = 'secondes';
$lang['years']                          = 'ans';
$lang['to']                             = 'à';