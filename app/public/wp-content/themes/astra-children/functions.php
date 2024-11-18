<?php


function wpchild_enqueue_styles() {
  
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/gsap.min.js', array(), null, true);
    wp_enqueue_script('ScrollTrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.1/ScrollTrigger.min.js', array(), null, true);
    
  wp_enqueue_style( 'astra-style', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('astra-style') );


  wp_enqueue_script('custom-init', get_stylesheet_directory_uri() . '/js/init.js', array(), null, true);


}

add_action( 'wp_enqueue_scripts', 'wpchild_enqueue_styles' );

function add_github_button_to_navbar($items, $args) {
    $github_button = '<li class="menu-item github-button">';
    $github_button .= '<a href="https://github.com/your-github-profile" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center;">';
    $github_button .= '<svg xmlns="http://www.w3.org/2000/svg" class="hover:fill-blue-500" fill="#ffffff" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true">';
    $github_button .= '<path d="M12,2C6.477,2,2,6.477,2,12c0,4.419,2.865,8.166,6.839,9.489c0.5,0.09,0.682-0.218,0.682-0.484 c0-0.236-0.009-0.866-0.014-1.699c-2.782,0.602-3.369-1.34-3.369-1.34c-0.455-1.157-1.11-1.465-1.11-1.465 c-0.909-0.62,0.069-0.608,0.069-0.608c1.004,0.071,1.532,1.03,1.532,1.03c0.891,1.529,2.341,1.089,2.91,0.833 c0.091-0.647,0.349-1.086,0.635-1.337c-2.22-0.251-4.555-1.111-4.555-4.943c0-1.091,0.39-1.984,1.03-2.682 C6.546,8.54,6.202,7.524,6.746,6.148c0,0,0.84-0.269,2.75,1.025C10.295,6.95,11.15,6.84,12,6.836 c0.85,0.004,1.705,0.114,2.504,0.336c1.909-1.294,2.748-1.025,2.748-1.025c0.546,1.376,0.202,2.394,0.1,2.646 c0.64,0.699,1.026,1.591,1.026,2.682c0,3.841-2.337,4.687-4.565,4.935c0.359,0.307,0.679,0.917,0.679,1.852 c0,1.335-0.012,2.415-0.012,2.741c0,0.269,0.18,0.579,0.688,0.481C19.138,20.161,22,16.416,22,12C22,6.477,17.523,2,12,2z"></path>';
    $github_button .= '</svg>';
    $github_button .= '</a></li>';


    $items .= $github_button;

    return $items;
}

add_filter('wp_nav_menu_items', 'add_github_button_to_navbar', 10, 2);


function taxonomie_Web_Project() {
  add_menu_page(
      'Gestion des Projets Web', // Titre de la page
      'Projets Web',            // Texte du menu
      'manage_options',        // Capacité requise
      'gestion_projets_web',   // Slug du menu
      'show_page_projets_web', // Fonction d'affichage
      'dashicons-portfolio',   // Icône du menu
      6                        // Position du menu
  );
}
add_action('admin_menu', 'taxonomie_Web_Project');

function show_page_projets_web() {
  global $wpdb;
  $table = $wpdb->prefix . 'projets_web';
  $projets = $wpdb->get_results("SELECT * FROM $table");

  ?>
  <div class="wrap">
      <h1>Ajouter un Projet Web</h1>
      <form method="post" enctype="multipart/form-data">
          <?php wp_nonce_field('enregistrer_projet_web', 'projet_web_nonce'); ?>
          <table class="form-table">
              <tr>
                  <th><label for="nom_projet">Nom du projet</label></th>
                  <td><input type="text" id="nom_projet" name="nom_projet" required></td>
              </tr>
              <tr>
                  <th><label for="description">Description du projet</label></th>
                  <td><input type="text" id="description" name="description" required></td>
              </tr>
              <tr>
                  <th><label for="code_source">Code source</label></th>
                  <td><input type="text" id="code_source" name="code_source" required></td>
              </tr>
              <tr>
                  <th><label for="lien_demo">Lien de démo</label></th>
                  <td><input type="url" id="lien_demo" name="lien_demo" required></td>
              </tr>
              <tr>
                 <th><label for="tags">Tags</label></th>
                    <td><input type="text" id="tags" name="tags" placeholder="Tags,Tags"></td>
              </tr>
              <tr>
                  <th><label for="image_projet">Image du projet</label></th>
                  <td><input type="file" id="image_projet" name="image_projet"></td>
              </tr>
          </table>
          <input type="submit" name="submit_projet" class="button button-primary" value="Enregistrer le projet">
      </form>

      <h2>Projets existants</h2>
      <table class="widefat">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Nom du projet</th>
                  <th>Description</th>
                  <th>Code source</th>
                  <th>Lien de démo</th>
                  <th>Tags</th> 
                  <th>Image</th>

              </tr>
          </thead>
          <tbody>
              <?php if ($projets) : ?>
                  <?php foreach ($projets as $projet) : ?>
                      <tr>
                          <td><?php echo esc_html($projet->id); ?></td>
                          <td><?php echo esc_html($projet->nom_projet); ?></td>
                          <td><?php echo esc_html($projet->description); ?></td>
                          <td><a href="<?php echo esc_url($projet->code_source); ?>" target="_blank"><?php echo esc_html($projet->code_source); ?></a></td>
                          <td><a href="<?php echo esc_url($projet->lien_demo); ?>" target="_blank"><?php echo esc_html($projet->lien_demo); ?></a></td>
                          <td>
                        <?php 
                        // Unserialize the tags and display them as a comma-separated list
                        $tags = !empty($projet->tags) ? unserialize($projet->tags) : [];
                        echo !empty($tags) ? implode(', ', $tags) : 'Aucun';
                        ?>
                    </td>
                          <td>
                              <?php if (!empty($projet->image_url)) : ?>
                                  <img src="<?php echo esc_url($projet->image_url); ?>" alt="<?php echo esc_attr($projet->nom_projet); ?>" style="max-width:100px;">
                              <?php else : ?>
                                  Aucun
                              <?php endif; ?>
                          </td>
                      </tr>
                  <?php endforeach; ?>
              <?php else : ?>
                  <tr>
                      <td colspan="5">Aucun projet enregistré.</td>
                  </tr>
              <?php endif; ?>
          </tbody>
      </table>
  </div>
  <?php
}

function create_table_projets_web() {
  global $wpdb;
  $table = $wpdb->prefix . 'projets_web';
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS $table (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      nom_projet varchar(255) NOT NULL,
      description varchar(255) NOT NULL,
      code_source varchar(255) NOT NULL,
      lien_demo varchar(255) NOT NULL,
      image_url varchar(255),
          tags varchar(255), 
      PRIMARY KEY  (id)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
create_table_projets_web(); 

function save_projet_web() {
    if (isset($_POST['submit_projet']) && check_admin_referer('enregistrer_projet_web', 'projet_web_nonce')) {
        global $wpdb;
        $table = $wpdb->prefix . 'projets_web';

        // Sanitize form inputs
        $nom_projet = sanitize_text_field($_POST['nom_projet']);
        $description = sanitize_text_field($_POST['description']);
        $code_source = sanitize_text_field($_POST['code_source']);
        $lien_demo = esc_url_raw($_POST['lien_demo']);
        $tags = isset($_POST['tags']) ? array_map('sanitize_text_field', explode(',', $_POST['tags'])) : [];

        // Serialize tags
        $tags_serialized = !empty($tags) ? serialize($tags) : '';

        // Handle file upload for the project image
        if (!empty($_FILES['image_projet']['name'])) {
            $upload = wp_handle_upload($_FILES['image_projet'], array('test_form' => false));
            $image_url = $upload && !isset($upload['error']) ? $upload['url'] : '';
        } else {
            $image_url = '';
        }

        // Insert data into the database
        $wpdb->insert($table, array(
            'nom_projet' => $nom_projet,
            'description' => $description,  // Corrected this line to use the proper variable
            'code_source' => $code_source,
            'lien_demo' => $lien_demo,
            'image_url' => $image_url,  // Added a comma here
            'tags' => $tags_serialized
        ));
    }
}
add_action('admin_init', 'save_projet_web');

function skills() {
    $skills = array(
        'html' => array(
            'image' => 'http://portfolio.local/wp-content/uploads/2024/11/HTML5_logo_and_wordmark.svg_.png',
            'name' => 'HTML',
            'level' => '5 ans',
            'alt' => 'HTML Icon'
        ),
        'css' => array(
            'image' => 'http://portfolio.local/wp-content/uploads/2024/11/CSS3_logo.png',
            'name' => 'CSS-SCSS',
            'level' => '5 ans',
            'alt' => 'CSS Icon'
        ),
        'js' => array(
            'image' => 'http://portfolio.local/wp-content/uploads/2024/11/Daco_4564885-1.png',
            'name' => 'JavaScript',
            'level' => '4 ans',
            'alt' => 'JavaScript Icon'
        ),
        'react' => array(
            'image' => 'http://portfolio.local/wp-content/uploads/2024/11/React.webp',
            'name' => 'React',
            'level' => '2 ans',
            'alt' => 'React Icon'
        ),
        'wordpress' => array(
            'image' => 'http://portfolio.local/wp-content/uploads/2024/11/wordpress-6942722_960_720.webp',
            'name' => 'WordPress',
            'level' => '1 ans',
            'alt' => 'WordPress Icon'
        )
    );

 
    $output = '<div class="custom-template">';
    
    foreach ($skills as $skill) {
        $class = $skill['name'] === 'JavaScript' ? 'icon-box js' : 'icon-box';
        
        $output .= '
        <div class="' . esc_attr($class) . '">
            <img src="' . esc_url($skill['image']) . '" alt="' . esc_attr($skill['alt']) . '" class="icon-image">
            <div class="skill-info">
                <div class="skill-name">' . esc_html($skill['name']) . '</div>
                <div class="skill-level">' . esc_html($skill['level']) . '</div>
            </div>
        </div>';
    }
    
    $output .= '</div>';
    
    return $output;
}
add_shortcode('skills', 'skills');

function display_projets_web_shortcode() {
    global $wpdb;
    $table = $wpdb->prefix . 'projets_web';
    $projets = $wpdb->get_results("SELECT * FROM $table");
  
    ob_start();
    ?>
  <div class="projets-web">
    <?php foreach ($projets as $projet): ?>
      <div class="projet-item">
        <div class="projet-image">
          <img src="<?php echo esc_url($projet->image_url); ?>" alt="<?php echo esc_attr($projet->nom_projet); ?>">
        </div>
        <div class="projet-overlay">
          <div class="projet-content">
            <h2 class="projet-titre"><?php echo esc_html($projet->nom_projet); ?></h2>
            <p class="projet-description"><?php echo esc_html($projet->description); ?></p>
            <div class="tags">
            <?php 
               
               $tags = !empty($projet->tags) ? unserialize($projet->tags) : [];
               if (!empty($tags)) {
                 foreach ($tags as $tag) {
                   echo '<span class="tag">' . esc_html($tag) . '</span>';
                 }
               }
               ?>
            </div>
            <div class="learn-more">
            <?php if (!empty($projet->code_source)): ?>
    <a href="<?php echo esc_url($projet->code_source); ?>" target="_blank">
        <svg xmlns="http://www.w3.org/2000/svg" class="hover:fill-blue-500" fill="#ffffff" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true">
            <path d="M12,2C6.477,2,2,6.477,2,12c0,4.419,2.865,8.166,6.839,9.489c0.5,0.09,0.682-0.218,0.682-0.484 c0-0.236-0.009-0.866-0.014-1.699c-2.782,0.602-3.369-1.34-3.369-1.34c-0.455-1.157-1.11-1.465-1.11-1.465 c-0.909-0.62,0.069-0.608,0.069-0.608c1.004,0.071,1.532,1.03,1.532,1.03c0.891,1.529,2.341,1.089,2.91,0.833 c0.091-0.647,0.349-1.086,0.635-1.337c-2.22-0.251-4.555-1.111-4.555-4.943c0-1.091,0.39-1.984,1.03-2.682 C6.546,8.54,6.202,7.524,6.746,6.148c0,0,0.84-0.269,2.75,1.025C10.295,6.95,11.15,6.84,12,6.836 c0.85,0.004,1.705,0.114,2.504,0.336c1.909-1.294,2.748-1.025,2.748-1.025c0.546,1.376,0.202,2.394,0.1,2.646 c0.64,0.699,1.026,1.591,1.026,2.682c0,3.841-2.337,4.687-4.565,4.935c0.359,0.307,0.679,0.917,0.679,1.852 c0,1.335-0.012,2.415-0.012,2.741c0,0.269,0.18,0.579,0.688,0.481C19.138,20.161,22,16.416,22,12C22,6.477,17.523,2,12,2z"></path>
        </svg>
    </a>
<?php endif; ?>
              <a href="<?php echo esc_url($projet->lien_demo); ?>" class="learn" target="_blank">En Savoir Plus <span class="arrow">&rarr;</span></a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
    <?php
    return ob_get_clean();
  }
  add_shortcode('web_Project', 'display_projets_web_shortcode');

  


function display_cookie_banner() {

    if (!isset($_COOKIE['cookies_accepted']) && !isset($_COOKIE['cookies_refused'])) {
        ?>
        <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; width: 100%; background-color: rgba(0, 0, 0, 0.8); color: white; text-align: center; padding: 15px; z-index: 9999;">
            <p style="margin: 0;">Ce site utilise des cookies uniquement pour la gestion des données liées au formulaire de contact. Aucun outil d'analyse n'est utilisé sur ce site. <a href="/politique-de-confidentialite" style="color: #00d0ff;">En savoir plus</a>.</p>
            <form method="post" style="display: inline;">
                <button type="submit" name="accept_cookies" style="background-color: #00d0ff; color: white; border: none; padding: 10px 20px; cursor: pointer;">Accepter</button>
            </form>
            <form method="post" style="display: inline;">
                <button type="submit" name="refuse_cookies" style="background-color: #ff4d4d; color: white; border: none; padding: 10px 20px; cursor: pointer;">Refuser</button>
            </form>
        </div>
        <?php
    }
}

add_action('init', 'display_cookie_banner');


function handle_cookies() {

    $time = 60 * 60 * 24 * 365;
    if (isset($_POST['accept_cookies'])) {
      
        setcookie('cookies_accepted', 'true', time() + 60 * 60 * 24 * 365, '/'); // 1 year

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }

    if (isset($_POST['refuse_cookies'])) {

        setcookie('cookies_refused', 'true', time() + 60 * 60 * 24 * 365, '/'); // 1 year
    
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}

add_action('init', 'handle_cookies');





// Kanap
// les petit plats
// Sport See
// Koukaki
// Planty
// Novus (pas de code source )
// GameOn