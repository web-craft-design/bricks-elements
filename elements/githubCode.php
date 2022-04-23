<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_GithubCode extends \Bricks\Element {
  /** 
   * How to create custom elements in Bricks
   * 
   * https://academy.bricksbuilder.io/article/create-your-own-elements
   */
  public $category     = 'web-craft.design';
  public $name         = 'wcde_github-code';
  public $icon         = 'fas fa-anchor'; // FontAwesome 5 icon in builder (https://fontawesome.com/icons)
  //public $css_selector = '.custom-title-wrapper'; // Default CSS selector for all controls with 'css' properties
  public $scripts      = ['wcd_codeBlock']; // Enqueue registered scripts by their handle

  public function enqueue_scripts() {
        wp_enqueue_script( 'wcd_codeBlock' );
        wp_enqueue_style( 'wcd_codeBlock' );
    }



  public function get_label() {
    return esc_html__( 'Github Code', 'bricks' );
  }

  public function set_control_groups() {
    $this->control_groups['footer'] = [
      'title' => esc_html__( 'Footer', 'bricks' ),
      'tab'   => 'content', // Accepts: 'content' or 'style'
    ];
    $this->control_groups['clipboard-button'] = [
      'title' => esc_html__( 'Clipboard Button', 'bricks' ),
      'tab'   => 'content', // Accepts: 'content' or 'style'
    ];
    $this->control_groups['clipboard-position'] = [
      'title' => esc_html__( 'Clipboard Position', 'bricks' ),
      'tab'   => 'content', // Accepts: 'content' or 'style'
    ];
  }  

  public function set_controls() {
    $this->controls['githubLink'] = [
      'tab'            => 'content',
      'label'          => esc_html__( 'Github Link', 'bricks' ),
      'type'           => 'text',
      'hasDynamicData' => 'text',
      'default'        => esc_html__( 'https://raw.githubusercontent.com/Wolfi1616/Bricks-Tutorial-Elements/main/README.md', 'bricks' ),
      'placeholder'    => esc_html__( 'Place Github RAW Link here', 'bricks' ),
    ];
    $this->controls['language'] = [
      'tab' => 'content',
      'label' => esc_html__( 'Language', 'bricks' ),
      'type' => 'select',
      'options' => [
        'language-markup' => 'HTML',
        'language-javascript' => 'Javascript',
        'language-php' => 'PHP',
        'language-css' => 'CSS',
      ],
      'inline' => false,
      'placeholder' => esc_html__( 'Select tag', 'bricks' ),
      'default' => 'language-markup',      
    ];



    // FOOTER: 

    $this->controls['footerText'] = [
      'tab'            => 'content',
      'group'          => 'footer',
      'label'          => esc_html__( 'Footer Text', 'bricks' ),
      'type'           => 'text',
      'hasDynamicData' => 'text',
      'default'        => esc_html__( 'Hosted with ❤️ by Github, created with bricks', 'bricks' ),
      'placeholder'    => esc_html__( 'Custom Text for Footer', 'bricks' ),
    ];
    $this->controls['footerTypography'] = [
      'tab'     => 'content',
      'group'   => 'footer',
      'label'   => esc_html__( 'Footer typography', 'bricks' ),
      'type'    => 'typography',
      'default' => [
        'color' => [
          'hex' => '#fff',
        ],
        'text-align' => 'right',
        'font-size' => '14px',
      ],
			'css'     => [
        [
          'property' => 'typography',
          'selector' => '.wcdb-code_footer',
        ],
      ],
    ];
    $this->controls['footerBackground'] = [
      'tab' => 'content',
      'group'   => 'footer',    
      'label' => esc_html__( 'Background color', 'bricks' ),
      'type' => 'color',
      'inline' => true,
      'css' => [
        [
          'property' => 'background-color',
          'selector' => '.wcdb-code_footer',
        ]
      ],
      'default' => [
        'hex' => '#272822',
      ],
    ];
    $this->controls['footerPadding'] = [
      'tab' => 'content',
      'group'   => 'footer',    
      'label' => esc_html__( 'Footer padding', 'bricks' ),
      'type' => 'dimensions',
      'css' => [
        [
          'property' => 'padding',
          'selector' => '.wcdb-code_footer',
        ]
      ],
      'default' => [
        'top' => 18,
        'right' => 18,
        'bottom' => 18,
        'left' => 18,
      ],
    ];
    $this->controls['footerBorder'] = [
      'tab' => 'content',
      'group'   => 'footer',    
      'label' => esc_html__( 'Footer Border', 'bricks' ),
      'type' => 'border',
      'css' => [
        [
          'property' => 'border',
          'selector' => '.wcdb-code_footer',
        ],
      ],
      'inline' => true,
      'small' => true,
      'default' => [
        'width' => [
          'top' => 3,
          'right' => 0,
          'bottom' => 0,
          'left' => 0,
        ],
        'style' => 'solid',
        'color' => [
          'hex' => '#fff',
        ],
      ],
    ];




		/**************************************
		***************************************
	 	******** CONTROLS SHOW BUTTONS ********
		***************************************
		**************************************/

    $this->controls['showButtons'] = [
			'tab' => 'content',
			'group' 	=> 'clipboard-button',
			'label' => esc_html__( 'Show Language/Clipboard Buttons', 'bricks' ),
			'type' => 'select',
			'options' => [
			  'none' => 'No',
			  'block' => 'Yes',
			],
			'css' => [
				[
				'property' => 'display',
				'selector' => '.toolbar',
				]
			],			
			'inline' => true,
			'placeholder' => esc_html__( 'Select tag', 'bricks' ),
			'default' => 'none', 
		];
	
		$this->controls['clipboardBackground'] = [
			'tab' => 'content',
			'group'   => 'clipboard-button',    
			'label' => esc_html__( 'Background color', 'bricks' ),
			'type' => 'color',
			'inline' => true,
			'css' => [
				[
				'property' => 'background-color',
				'selector' => 'div.code-toolbar>.toolbar>.toolbar-item>button, div.code-toolbar>.toolbar>.toolbar-item>span',
				'important' => true,
				]
			],
			'default' => [
				'hex' => '#3f00b5',
			],
			'required' => [ 'showButtons', '=', 'block' ],
		]; 
		$this->controls['clipboardBorder'] = [
			'tab' => 'content',
			'group'   => 'clipboard-button',    
			'label' => esc_html__( 'Border', 'bricks' ),
			'type' => 'border',
			'css' => [
				[
				'property' => 'border',
				'selector' => 'div.code-toolbar>.toolbar>.toolbar-item>button, div.code-toolbar>.toolbar>.toolbar-item>span',
				'important' => true,
				],
			],
			'inline' => true,
			'small' => true,
			'default' => [
				'radius' => [
				'top' => 8,
				'right' => 8,
				'bottom' => 8,
				'left' => 8,
				],
			],
			'required' => [ 'showButtons', '=', 'block' ],
		];
		$this->controls['clipboardPadding'] = [
			'tab' => 'content',
			'group'   => 'clipboard-button',    
			'label' => esc_html__( 'Padding', 'bricks' ),
			'type' => 'dimensions',
			'css' => [
				[
				'property' => 'padding',
				'selector' => 'div.code-toolbar>.toolbar>.toolbar-item>button, div.code-toolbar>.toolbar>.toolbar-item>span',
				'important' => true,
				]
			],
			'default' => [
				'top' => 6,
				'right' => 25,
				'bottom' => 6,
				'left' => 25,
			],
			'required' => [ 'showButtons', '=', 'block' ],
		];
		$this->controls['clipboardTypography'] = [
			'tab'     => 'content',
			'group'   => 'clipboard-button',
			'label'   => esc_html__( 'Typography', 'bricks' ),
			'type'    => 'typography',
			'default' => [
				'color' => [
				'hex' => '#fff',
				],
				'font-size' => '16px',
			],
					'css'     => [
				[
				'property' => 'typography',
				'selector' => 'div.code-toolbar>.toolbar>.toolbar-item>button, div.code-toolbar>.toolbar>.toolbar-item>span',
				'important' => true,
				],
			],
			'required' => [ 'showButtons', '=', 'block' ],
		];


    
    // Clipboard Position: 
    $this->controls['clipboardPositionTop'] = [
      'tab' => 'content',
      'group' => 'clipboard-position',
      'label' => esc_html__( 'Top', 'bricks' ),
      'type' => 'number',
      'units' => [],
      'inline' => true,
      'css' => [
        [
          'property' => 'top',
          'selector' => '.code-toolbar > .toolbar',
        ],
      ],
      'default' => 'auto',
    ];
    $this->controls['clipboardPositionRight'] = [
      'tab' => 'content',
      'group' => 'clipboard-position',
      'label' => esc_html__( 'Right', 'bricks' ),
      'type' => 'number',
      'units' => [],
      'inline' => true,
      'css' => [
        [
          'property' => 'right',
          'selector' => '.code-toolbar > .toolbar',
        ],
      ],
      'default' => 'auto',
    ];
    $this->controls['clipboardPositionBottom'] = [
      'tab' => 'content',
      'group' => 'clipboard-position',
      'label' => esc_html__( 'Bottom', 'bricks' ),
      'type' => 'number',
      'units' => [],
      'inline' => true,
      'css' => [
        [
          'property' => 'bottom',
          'selector' => '.code-toolbar > .toolbar',
        ],
      ],
      'default' => '-50px',
    ];
    $this->controls['clipboardPositionLeft'] = [
      'tab' => 'content',
      'group' => 'clipboard-position',
      'label' => esc_html__( 'Left', 'bricks' ),
      'type' => 'number',
      'units' => [],
      'inline' => true,
      'css' => [
        [
          'property' => 'left',
          'selector' => '.code-toolbar > .toolbar',

        ],
      ],
      'default' => 'auto',
    ];

  }

  /** 
   * Render element HTML on frontend
   * 
   * If no 'render_builder' function is defined then this code is used to render element HTML in builder, too.
   */
  public function render() {
    $settings = $this->settings;
    //print_r($settings);

    $githubLink    = ! empty( $settings['githubLink'] ) ? $settings['githubLink'] : false;
    $language    = ! empty( $settings['language'] ) ? $settings['language'] : false;
    $footerText    = ! empty( $settings['footerText'] ) ? $settings['footerText'] : false;

    // Return element placeholder
    if ( !$githubLink ) {
      return $this->render_element_placeholder( [
        'icon-class'  => 'ti-github',
        'title'       => esc_html__( 'Please add the Link to your snippet!', 'bricks' ),
      ] );
    }

/**
 * '_root' attribute contains element ID, classes, etc. 
 * 
 * @since 1.4
 */
    $targetID = 'github-' . $this->id;
    $output .= "<div {$this->render_attributes( '_root' )}> <pre class='{$language} line-numbers'>";



    if ( $githubLink ) {
        $this->set_attribute('targetID', 'id', $targetID);
        $output .= "<code {$this->render_attributes('targetID')}>$githubLink</code>";  
    }


    $output .= '</pre>';

    if ( $footerText ) {
      
      $output .= "<div class='wcdb-code_footer'>$footerText</div>";

    }



    $output .= '
    <script>
    var gitHubLink = "' . $githubLink . '";

    getCodeAsRawTextFromGithub().then(data => {
        let preProcessedData = preProcessData(data);
        document.getElementById("' . $targetID . '").innerHTML = preProcessedData;
        Prism.highlightAll();
    });

    async function getCodeAsRawTextFromGithub() {
        let response = await fetch(gitHubLink);
        let rawText = await response.text();
        return rawText;
    }

    function preProcessData(data) {
        data = data.replaceAll("<", "&lt;");
        data = data.replaceAll(">", "&gt;");
        return data;
    }

    </script>
    ';


    $output .= '</div>';


	// Output final element HTML
	echo $output;
  }

/*
  public static function render_builder() { ?>
    <script type="text/x-template" id="tmpl-bricks-element-github">
        <component>
            <contenteditable
                v-if="settings.githubLink" 
                :name="name"
                :settings="settings"
                controlKey="title"
            />

            <contenteditable
                v-if="settings.subtitle" 
                :name="name"
                :settings="settings"
                controlKey="subtitle"
                class="subtitle"/>
        </component>
    </script>
<?php
}


*/




}