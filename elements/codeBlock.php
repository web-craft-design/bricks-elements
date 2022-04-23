<?php
namespace Bricks;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Element_Custom_codeBlock extends Element {
	public $block    = [ 'core/code', 'core/preformatted' ];
	public $category = 'web-craft.design';
	public $name     = 'wcde-code_block';
	public $icon     = 'ion-ios-code';
	public $scripts  = [ 'wcd_codeBlock' ];


	public function get_label() {
		return esc_html__( 'Code Block', 'bricks' );
	}


    public function set_control_groups() {#
        $this->control_groups['flex'] = [
            'title' => esc_html__( 'Flex Controls', 'bricks' ),
            'tab'   => 'content', // Accepts: 'content' or 'style'
		];		
        $this->control_groups['php'] = [
            'title' => esc_html__( 'PHP & HTML', 'bricks' ),
            'tab'   => 'content', // Accepts: 'content' or 'style'
		];
        $this->control_groups['js'] = [
        'title' => esc_html__( 'Javascript', 'bricks' ),
        'tab'   => 'content', // Accepts: 'content' or 'style'
        ];
        $this->control_groups['css'] = [
            'title' => esc_html__( 'CSS', 'bricks' ),
            'tab'   => 'content', // Accepts: 'content' or 'style'
		];
		$this->control_groups['clipboard-button'] = [
            'title' => esc_html__( 'Prettify Code', 'bricks' ),
            'tab'   => 'content', // Accepts: 'content' or 'style'
			'required' => [ 'executeCode', '=', '' ],

		];     
	}









	public function set_controls() {
		// NOTE: Undocumented (enable code execution first under: Bricks > Settings > Builder Access)
		$execution_allowed = apply_filters( 'bricks/code/allow_execution', ! Database::get_setting( 'executeCodeDisabled', false ) );

		if ( $execution_allowed ) {
			$this->controls['executeCode'] = [
				'tab'      => 'content',
				'label'    => esc_html__( 'Execute code', 'bricks' ),
				'type'     => 'checkbox',
			];	
	
		}


		$this->controls['code'] = [
			'tab'       => 'content',
			'group' 	=> 'php',
			'type'      => 'code',
			'mode'      => 'php',
			'clearable' => false, // Required to always have 'mode' set for CodeMirror
			'default'   => "<h1 class='my-heading'>\n  Post-ID: \n  <?php \n     global \$post;\n     echo \$post->ID; \n  ?>\n</h1>",
			'rerender'  => true,
		];
		$this->controls['language'] = [
			'tab' => 'content',
			'group' 	=> 'php',
			'label' => esc_html__( 'Language', 'bricks' ),
			'type' => 'select',
			'tooltip'  => [
				'content'  => 'for highlighting code on frontend!',
				'position' => 'top-left',
			],			
			'options' => [
			  'language-markup' => 'HTML',
			  'language-php' => 'PHP',
			],
			'inline' => false,
			'placeholder' => esc_html__( 'Select tag', 'bricks' ),
			'default' => 'language-php', 
			'required' => [ 'executeCode', '=', '' ],
		];

		$this->controls['codeJS'] = [
			'tab'       => 'content',
			'group' 	=> 'js',
			'type'      => 'code',
			'mode'      => 'js',
			'clearable' => false, // Required to always have 'mode' set for CodeMirror
			'default'   => "console.log('test')",
			'rerender'  => true,
		];

		$this->controls['codeCSS'] = [
			'tab'       => 'content',
			'group' 	=> 'css',
			'type'      => 'code',
			'mode'      => 'css',
			'clearable' => false, // Required to always have 'mode' set for CodeMirror
			'default'   => "h1.my-heading {\n  color: crimson;\n}",
			'rerender'  => true,
		];




		/******************************
		*******************************
	 	******** FLEX-CONTROLS ********
		*******************************
		******************************/

		$this->controls['codeDisplay'] = [
			'tab' => 'content',
			'group' => 'flex',
			'label' => esc_html__( 'Display', 'bricks' ),
			'type' => 'select',
			'options' => [
			  'flex' => esc_html__( 'Flex', 'bricks' ),
			  'block' => esc_html__( 'Block', 'bricks' ),
			  'none' => esc_html__( 'None', 'bricks' ),
			],
			'inline' => true,
			'css' => [
			  [
				'property' => 'display',
				//'selector' => '.prefix-title',
			  ],
			],
			'default' => 'flex',
			'placeholder' => esc_html__( 'Select', 'bricks' ),
		  ];
		  $this->controls['flexWrap'] = [
			'tab' => 'content',
			'group' => 'flex',

			'label' => esc_html__( 'Flex-Wrap', 'bricks' ),
			'type' => 'select',
			'options' => [
			  'wrap' => esc_html__( 'Wrap', 'bricks' ),
			  'no-wrap' => esc_html__( 'No Wrap', 'bricks' ),
			],
			'inline' => true,
			'css' => [
			  [
				'property' => 'flex-wrap',
			  ],
			],
			'placeholder' => esc_html__( 'Select', 'bricks' ),
			'required' => [
				[ 'codeDisplay', '=', 'flex' ],
			],
		  ];
	  
		  $this->controls['direction'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'    => esc_html__( 'Direction', 'bricks' ),
			  'type'     => 'direction',
			  'css'      => [
				  [
					  'property' => 'flex-direction',
				  ],
			  ],
			  'inline'   => true,
			  'rerender' => true,
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
			  'default' => 'column',
		  ];
		  $this->controls['alignSelf'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label' => esc_html__( 'Align Self', 'bricks' ),
			  'type' => 'align-items',
			  'css' => [
				[
					'property'  => 'align-self',
					'important' => true,
				],
				[
					'selector' => '',
					'property' => 'width',
					'value'    => '100%',
					'required' => 'stretch', // NOTE: Undocumented (@since 1.4)
				],
				[
					'selector' => '',
					'property' => 'max-width',
					'value'    => '100%',
					'required' => 'stretch', // NOTE: Undocumented (@since 1.4)
				],
			  ],
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
	  
		  ];		  

		  $this->controls['justifyContent'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label' => esc_html__( 'Justify content', 'bricks' ),
			  'type' => 'justify-content',
			  'css' => [
				[
				  'property' => 'justify-content',
				],
			  ],
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
	  
		  ];
		  $this->controls['alignItems'] = [
				'tab' => 'content',
				'group' => 'flex',

			  'label'    => esc_html__( 'Align Items', 'bricks' ),
			  'type'     => 'align-items',
			  'css'      => [
				  [
					  'property' => 'align-items',
				  ],
			  ],
			  'default' => 'stretch',
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
	  
		  $this->controls['rowGap'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'    => esc_html__( 'Row gap', 'bricks' ),
			  'type'     => 'number',
			  'units'    => true,
			  'css'      => [
				  [
					  'property' => 'row-gap',
				  ],
			  ],
			  'required' => [
				  [ 'direction', '=', [ '', 'column', 'column-reverse' ] ],
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
		  $this->controls['columnGap'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'    => esc_html__( 'Column gap', 'bricks' ),
			  'type'     => 'number',
			  'units'    => true,
			  'css'      => [
				  [
					  'property' => 'column-gap',
				  ],
			  ],
			  'required' => [
				  [ 'direction', '=', [ 'row', 'row-reverse' ] ],
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
	  
		  $this->controls['flexseparator'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'type' => 'separator',
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
	  
		  $this->controls['flexGrow'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'       => esc_html__( 'Flex grow', 'bricks' ),
			  'type'        => 'number',
			  'min'         => 0,
			  'css'         => [
				  [
					  'property' => 'flex-grow',
				  ],
			  ],
			  'placeholder' => 0,
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
	  
		  $this->controls['flexShrink'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'       => esc_html__( 'Flex shrink', 'bricks' ),
			  'type'        => 'number',
			  'min'         => 0,
			  'css'         => [
				  [
					  'property' => 'flex-shrink',
				  ],
			  ],
			  'placeholder' => 1,
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];
	  
		  $this->controls['flexBasis'] = [
			'tab' => 'content',
			'group' => 'flex',

			  'label'          => esc_html__( 'Flex basis', 'bricks' ),
			  'type'           => 'text',
			  'css'            => [
				  [
					  'property' => 'flex-basis',
				  ],
			  ],
			  'inline'         => true,
			  'small'          => true,
			  'placeholder'    => 'auto',
			  'hasDynamicData' => false,
			  'required' => [
				  [ 'codeDisplay', '=', 'flex' ],
			  ],
		  ];












		/**************************************
		***************************************
	 	******** CONTROLS SHOWING-CODE ********
		***************************************
		**************************************/
		$this->controls['infoDocumentation'] = [
				'tab'     => 'content',
				'group'   => 'clipboard-button',    
				'content' => esc_html__( 'You can set different settings here for showing code, those settings won\'t get applied if you execute code!', 'bricks' ),
				'type'    => 'info',
		];		



		$this->controls['separator'] = [
			'tab'  => 'content',
			'group' => 'clipboard-button',
			'type' => 'separator',
		];




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
		$this->controls['clipboardPositionTop'] = [
			'tab' => 'content',
			'group' => 'clipboard-button',
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
			'default' => 10,
			'required' => [ 'showButtons', '=', 'block' ],
		];
		$this->controls['clipboardPositionRight'] = [
			'tab' => 'content',
			'group' => 'clipboard-button',
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
			'default' => 10,
			'required' => [ 'showButtons', '=', 'block' ],
		];
		$this->controls['clipboardPositionBottom'] = [
			'tab' => 'content',
			'group' => 'clipboard-button',
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
			'default' => 'auto',
			'required' => [ 'showButtons', '=', 'block' ],
		];
		$this->controls['clipboardPositionLeft'] = [
			'tab' => 'content',
			'group' => 'clipboard-button',
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
			'required' => [ 'showButtons', '=', 'block' ],
		];
		

        


    }
















	public function render() {
		/**************************
		***************************
	 	******** VARIABLES ********
		***************************
		**************************/
		$settings = $this->settings;

		$codePHP  = ! empty( $settings['code'] ) ? $settings['code'] : false;
		$codeJS  = ! empty( $settings['codeJS'] ) ? $settings['codeJS'] : false;
		$codeCSS  = ! empty( $settings['codeCSS'] ) ? $settings['codeCSS'] : false;

		$language  = ! empty( $settings['language'] ) ? $settings['language'] : false;



        // ENQUEUE STYLES FOR CODE-HIGHLIGHTING:
        if ( empty( $settings['executeCode'] ) ){
            wp_enqueue_script( 'wcd_codeBlock' );
            wp_enqueue_style( 'wcd_codeBlock' );
        }


		if ( $codeJS || $codePHP || $codeCSS ) {
			echo "<div {$this->render_attributes( '_root' )}>";
		}

		/*********************************
		**********************************
	 	******** PHP CODE - LOGIK ********
		**********************************
		*********************************/

		if ( empty( $codePHP ) ) {
			$this->render_element_placeholder( ['title' => esc_html__( 'No PHP code found.', 'bricks' )] );
		}
		// STEP: Execute code
		if ( ! empty( $settings['executeCode'] ) ) {
			$execution_allowed = apply_filters( 'bricks/code/allow_execution', ! Database::get_setting( 'executeCodeDisabled', false ) );

			// Return: Code execution not allowed
			if ( ! $execution_allowed ) {
				return $this->render_element_placeholder(
					[
						'title'       => esc_html__( 'Code execution not allowed.', 'bricks' ),
						'description' => esc_html__( 'You can manage code execution permissions under: Bricks > Settings > Builder Access > Code Execution', 'bricks' )
					]
				);
			}

			/**
			 * Filter $codePHP content to prevent dangerous calls
			 *
			 * @since 1.3.7
			 */
			$disallow = apply_filters( 'bricks/code/disallow_keywords', [] );

			if ( ! empty( $disallow ) ) {
				foreach ( (array) $disallow as $keyword ) {
					if ( stripos( $codePHP, $keyword ) !== false ) {
						return $this->render_element_placeholder(
							[
								'title'       => esc_html__( 'Code is not executed as it contains the following disallowed keyword', 'bricks' ) . ': ' . $keyword,
								'description' => Helpers::article_link( 'filter-bricks-code-disallow_keywords', esc_html__( 'Visit Bricks Academy', 'bricks' ) )
							]
						);
					}
				}
			}

			// Sets the context on AJAX calls or on reloading the builder
			if ( bricks_is_ajax_call() ) {
				global $post;

				$post = get_post( $this->post_id );

				setup_postdata( $post );
			}

			ob_start();

			// Prepare & set error reporting
			$error_reporting = error_reporting( E_ALL );
			$display_errors  = ini_get( 'display_errors' );
			ini_set( 'display_errors', 1 );

			try {
				$result = eval( ' ?>' . $codePHP . '<?php ' );
			}

			catch ( \Exception $e ) {
				echo 'Exception: ' . $error->getMessage();

				return;
			}

			catch ( \ParseError $error ) {
				echo 'ParseError: ' . $error->getMessage();

				return;
			}

			catch ( \Error $error ) {
				echo 'Error: ' . $error->getMessage();

				return;
			}

			// Reset error reporting
			ini_set( 'display_errors', $display_errors );
			error_reporting( $error_reporting );

			// @see https://www.php.net/manual/en/function.eval.php
			if ( version_compare( PHP_VERSION, '7', '<' ) && $result === false || ! empty( $error ) ) {
				$output = $error;

				ob_end_clean();
			} else {
				$output = ob_get_clean();
			}

			if ( bricks_is_builder() || bricks_is_ajax_call() ) {
				wp_reset_postdata();

				echo $output;
			}

			// Frontend
			else {
				echo $output;
			}

		} else {

			// ELSE: CHECKBOX NOT CHECKED (CODE NOT EXECUTED):
			// Escaping
			$codePHP = esc_html( $codePHP );
			echo "<pre class='{$language} line-numbers'><code>{$codePHP}</code></pre>";


		}








		/********************************
		*********************************
	 	******** JS CODE - LOGIK ********
		*********************************
		********************************/

		if ( empty( $codeJS ) ) {
			$this->render_element_placeholder( ['title' => esc_html__( 'No JS code found.', 'bricks' )] );
		} else {

			if ( ! empty( $settings['executeCode'] ) ) {
				echo "<script defer>{$codeJS}</script>";
			} else {
				echo "<pre class='language-javascript line-numbers'><code>{$codeJS}</code></pre>";
			}
		}




		/*********************************
		**********************************
	 	******** CSS CODE - LOGIK ********
		**********************************
		*********************************/

		if ( empty( $codeCSS ) ) {
			$this->render_element_placeholder( ['title' => esc_html__( 'No CSS code found.', 'bricks' )] );
		} else {

			if ( ! empty( $settings['executeCode'] ) ) {
			echo "<style>{$codeCSS}</style>";
			} else {
				echo "<pre class='language-css line-numbers'><code>{$codeCSS}</code></pre>";
			}
		}



		//CLOSE ROOT CONTAINER:
		if ( $codeJS || $codePHP || $codeCSS ) {
			echo "</div>";
		}
	
	}




}
