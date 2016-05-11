fos.Router.setData({"base_url":"","routes":{"console":{"tokens":[["text","\/_console\/_console"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"console_exec":{"tokens":[["variable",".","json","_format"],["text","\/_console\/_console\/commands"]],"defaults":{"_format":"json"},"requirements":{"_format":"json","_method":"POST"},"hosttokens":[]},"_wdt":{"tokens":[["variable","\/","[^\/]++","token"],["text","\/_wdt"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_home":{"tokens":[["text","\/_profiler\/"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_search":{"tokens":[["text","\/_profiler\/search"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_search_bar":{"tokens":[["text","\/_profiler\/search_bar"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_purge":{"tokens":[["text","\/_profiler\/purge"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_info":{"tokens":[["variable","\/","[^\/]++","about"],["text","\/_profiler\/info"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_phpinfo":{"tokens":[["text","\/_profiler\/phpinfo"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_search_results":{"tokens":[["text","\/search\/results"],["variable","\/","[^\/]++","token"],["text","\/_profiler"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler":{"tokens":[["variable","\/","[^\/]++","token"],["text","\/_profiler"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_router":{"tokens":[["text","\/router"],["variable","\/","[^\/]++","token"],["text","\/_profiler"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_exception":{"tokens":[["text","\/exception"],["variable","\/","[^\/]++","token"],["text","\/_profiler"]],"defaults":[],"requirements":[],"hosttokens":[]},"_profiler_exception_css":{"tokens":[["text","\/exception.css"],["variable","\/","[^\/]++","token"],["text","\/_profiler"]],"defaults":[],"requirements":[],"hosttokens":[]},"_configurator_home":{"tokens":[["text","\/_configurator\/"]],"defaults":[],"requirements":[],"hosttokens":[]},"_configurator_step":{"tokens":[["variable","\/","[^\/]++","index"],["text","\/_configurator\/step"]],"defaults":[],"requirements":[],"hosttokens":[]},"_configurator_final":{"tokens":[["text","\/_configurator\/final"]],"defaults":[],"requirements":[],"hosttokens":[]},"_twig_error_test":{"tokens":[["variable",".","[^\/]++","_format"],["variable","\/","\\d+","code"],["text","\/_error"]],"defaults":{"_format":"html"},"requirements":{"code":"\\d+"},"hosttokens":[]},"bds_sabre_dav_homepage":{"tokens":[["variable","\/","[^\/]++","name"],["text","\/hello"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_calendrier_sport":{"tokens":[["variable","\/","[^\/]++","annee"],["variable","\/","[^\/]++","mois"],["variable","\/","[^\/]++","jour"],["text","\/calendrier"],["variable","\/","[^\/]++","nom"],["text","\/sport"]],"defaults":{"jour":null,"mois":null,"annee":null},"requirements":[],"hosttokens":[]},"bds_calendrier_header":{"tokens":[["variable","\/","[^\/]++","date"],["text","\/calendrier\/header"]],"defaults":{"date":null},"requirements":[],"hosttokens":[]},"bds_calendrier_jour_semaine":{"tokens":[["variable","\/","[^\/]++","date"],["text","\/calendrier\/jours\/semaine"]],"defaults":{"date":null},"requirements":[],"hosttokens":[]},"bds_load_cal_sport":{"tokens":[["variable","\/","[^\/]++","date"],["variable","\/","[^\/]++","nom"],["text","\/calendrier\/events"]],"defaults":{"date":null},"requirements":[],"hosttokens":[]},"bds_chat_show":{"tokens":[["variable","\/","[^\/]++","channel"],["text","\/chat\/show"]],"defaults":{"channel":"default"},"requirements":[],"hosttokens":[]},"bds_chat_list":{"tokens":[["variable","\/","[^\/]++","channel"],["text","\/chat\/list"]],"defaults":{"channel":"default"},"requirements":[],"hosttokens":[]},"bds_chat_post":{"tokens":[["variable","\/","[^\/]++","channel"],["text","\/chat\/post"]],"defaults":{"channel":"default"},"requirements":[],"hosttokens":[]},"bds_sport_view":{"tokens":[["variable","\/","[^\/]++","nom"],["text","\/capitaine"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_add":{"tokens":[["text","\/admin\/sport\/add"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_delete":{"tokens":[["text","\/delete"],["variable","\/","[^\/]++","nom"],["text","\/admin"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_edit":{"tokens":[["text","\/edit"],["variable","\/","[^\/]++","nom"],["text","\/capitaine"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_list":{"tokens":[["text","\/sport"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_equipe":{"tokens":[["text","\/equipe"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_presentation":{"tokens":[["text","\/presentation"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_presentation_edit":{"tokens":[["text","\/presentation\/edit"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_motCapitaine":{"tokens":[["text","\/mot_du_capitaine"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sport_motCapitaineEdit":{"tokens":[["text","\/mot_du_capitaine\/edit"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_capitaine_equipe":{"tokens":[["text","\/equipe"],["variable","\/","[^\/]++","nom"],["text","\/capitaine"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_admin_configuration_add":{"tokens":[["text","\/admin\/configuration\/add"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sponsor_add":{"tokens":[["text","\/admin\/sponsor\/add"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sponsor_view":{"tokens":[["variable","\/","[^\/]++","nom"],["text","\/admin\/sponsor\/view"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sponsor_list":{"tokens":[["text","\/admin\/sponsor\/list"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_sponsor_delete":{"tokens":[["variable","\/","[^\/]++","nom"],["text","\/admin\/sponsor\/delete"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_evenement_index":{"tokens":[["variable","\/","\\d*","page"],["text","\/evenement"],["variable","\/","[^\/]++","nom"]],"defaults":{"page":1},"requirements":{"page":"\\d*"},"hosttokens":[]},"bds_evenement_view":{"tokens":[["variable","\/","[^\/]++","affichage"],["variable","\/","\\d*","id"],["text","\/evenement\/view"],["variable","\/","[^\/]++","nom"]],"defaults":{"affichage":"drag_n_drop"},"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_evenement_add":{"tokens":[["text","\/evenement\/add"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_evenement_delete":{"tokens":[["variable","\/","\\d*","id"],["text","\/evenement\/delete"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_evenement_edit":{"tokens":[["variable","\/","\\d*","id"],["text","\/evenement\/edit"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_evenement_feuille":{"tokens":[["text","\/feuilleDeMatche"],["variable","\/","[^\/]++","id"],["text","\/evenement"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_capitaine_evenement":{"tokens":[["text","\/evenement"],["variable","\/","[^\/]++","nom"],["text","\/capitaine"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_image_upload":{"tokens":[["text","\/image\/upload"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_image_view":{"tokens":[["variable","\/","[^\/]++","nom"],["text","\/image"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_image_delete":{"tokens":[["variable","\/","[^\/]++","nom"],["text","\/image\/delete"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_news_home":{"tokens":[["variable","\/","\\d*","page"],["text","\/news\/accueil"],["variable","\/","[^\/]++","nom"]],"defaults":{"page":1,"nom":"bds"},"requirements":{"page":"\\d*"},"hosttokens":[]},"bds_news_view":{"tokens":[["variable","\/","\\d*","id"],["text","\/news"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_news_add":{"tokens":[["text","\/news\/add"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_news_edit":{"tokens":[["variable","\/","\\d*","id"],["text","\/news\/edit"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_news_delete":{"tokens":[["variable","\/","\\d*","id"],["text","\/news\/delete"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_news_validate":{"tokens":[["variable","\/","\\d*","id"],["text","\/news\/validate"],["variable","\/","[^\/]++","nom"]],"defaults":[],"requirements":{"id":"\\d*"},"hosttokens":[]},"bds_capitaine_news":{"tokens":[["text","\/news"],["variable","\/","[^\/]++","nom"],["text","\/capitaine"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_home_page":{"tokens":[["text","\/"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_list":{"tokens":[["text","\/admin\/utilisateur\/liste"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_sport_add":{"tokens":[["text","\/profile\/ajouter_un_sport"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_sport_delete":{"tokens":[["variable","\/","[^\/]++","id"],["text","\/profile\/supprimer"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_show":{"tokens":[["text","\/profile"],["variable","\/","[^\/]++","username"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_message":{"tokens":[["text","\/message"],["variable","\/","[^\/]++","username"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_stats":{"tokens":[["text","\/stats"],["variable","\/","[^\/]++","username"]],"defaults":[],"requirements":[],"hosttokens":[]},"bds_user_pic":{"tokens":[["text","\/profilePic\/changer_tof"]],"defaults":[],"requirements":[],"hosttokens":[]},"homepage":{"tokens":[["text","\/app\/example"]],"defaults":[],"requirements":[],"hosttokens":[]},"fos_user_security_login":{"tokens":[["text","\/login"]],"defaults":[],"requirements":{"_method":"GET|POST"},"hosttokens":[]},"fos_user_security_check":{"tokens":[["text","\/login_check"]],"defaults":[],"requirements":{"_method":"POST"},"hosttokens":[]},"fos_user_security_logout":{"tokens":[["text","\/logout"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_profile_show":{"tokens":[["text","\/profile\/"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_profile_edit":{"tokens":[["text","\/profile\/edit"]],"defaults":[],"requirements":{"_method":"GET|POST"},"hosttokens":[]},"fos_user_registration_register":{"tokens":[["text","\/register\/"]],"defaults":[],"requirements":{"_method":"GET|POST"},"hosttokens":[]},"fos_user_registration_check_email":{"tokens":[["text","\/register\/check-email"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_registration_confirm":{"tokens":[["variable","\/","[^\/]++","token"],["text","\/register\/confirm"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_registration_confirmed":{"tokens":[["text","\/register\/confirmed"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_resetting_request":{"tokens":[["text","\/resetting\/request"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_resetting_send_email":{"tokens":[["text","\/resetting\/send-email"]],"defaults":[],"requirements":{"_method":"POST"},"hosttokens":[]},"fos_user_resetting_check_email":{"tokens":[["text","\/resetting\/check-email"]],"defaults":[],"requirements":{"_method":"GET"},"hosttokens":[]},"fos_user_resetting_reset":{"tokens":[["variable","\/","[^\/]++","token"],["text","\/resetting\/reset"]],"defaults":[],"requirements":{"_method":"GET|POST"},"hosttokens":[]},"fos_user_change_password":{"tokens":[["text","\/password\/change-password"]],"defaults":[],"requirements":{"_method":"GET|POST"},"hosttokens":[]},"fos_js_routing_js":{"tokens":[["variable",".","js|json","_format"],["text","\/js\/routing"]],"defaults":{"_format":"js"},"requirements":{"_format":"js|json"},"hosttokens":[]}},"prefix":"","host":"localhost","scheme":"http"});