'use strict';

module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);


	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		app: 'public',
		dist: 'webroot',

		sass: {
			options: {
				includePaths: ['<%= app %>/components/foundation/scss']
			},
			dist: {
				options: {
					outputStyle: 'extended'
				},
				files: {
					'<%= app %>/css/app.css': '<%= app %>/scss/app.scss'
				}
			}
		},

		jshint: {
			options: {
				jshintrc: '.jshintrc'
			},
			all: [
				'Gruntfile.js',
				'<%= app %>/js/**/*.js'
			]
		},

		clean: {
			dist: {
				src: ['<%= dist %>/css/*', '<%= dist %>/js/*', '<%= dist %>/fonts/*',]
			},
		},

		copy: {
			dist: {
				files: [{
					expand: true,
					cwd:'<%= app %>',
					src: ['fonts/**', '**/*.html', '*.txt', '!**/*.scss', '!components/**'],
					dest: '<%= dist %>'
				} , {
					expand: true,
					flatten: true,
					src: ['<%= app %>/components/font-awesome/fonts/**'],
					dest: '<%= dist %>/fonts/',
					filter: 'isFile'
				}, {
					expand: true,
					flatten: true,
					src: [
						'<%= app %>/components/font-awesome/css/*.min.css',
						'<%= app %>/components/octicons/octicons/*.ttf',
						'<%= app %>/components/octicons/octicons/*.woff',
						'<%= app %>/components/octicons/octicons/*.svg',
						'<%= app %>/components/octicons/octicons/*.eot'],
					dest: '<%= dist %>/css/',
					filter: 'isFile'
				} ]
			},
		},

		cssmin: {
		  target: {
			files: [{
			  expand: true,
			  cwd: '<%= app %>/css',
			  src: ['*.css', '!*.min.css'],
			  dest: '<%= dist %>/css',
			  ext: '.min.css'
			}]
		  }
		},

		imagemin: {
			target: {
				files: [{
					expand: true,
					cwd: '<%= app %>/images/',
					src: ['**/*.{jpg,gif,svg,jpeg,png}'],
					dest: '<%= dist %>/img/'
				}]
			}
		},

		uglify: {
			options: {
				preserveComments: 'some',
				mangle: false
			}
		},

		concat: {
          css: {
            src: [
                'public/components/bootswatch-dist/css/bootstrap.min.css',
                'public/components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css',
                '<%= app %>/css/wowchar.css',
                'public/components/chosen/chosen.min.css',
                'public/components/font-awesome/css/font-awesome.min.css'
            ],
            dest: '<%= app %>/css/app.css'
          },
		  js: {
		    src: [
		    	'public/components/jquery/dist/jquery.min.js',
		    	'public/components/bootstrap/dist/js/bootstrap.min.js',
		    	'public/components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
		    	'public/components/sharrre/jquery.sharrre.min.js',
		    	'public/components/zeroclipboard/dist/ZeroClipboard.min.js',
		    	'public/components/chosen/chosen.jquery.min.js'
	    	],
		    dest: '<%= dist %>/js/libraries.js'
		  },
		},

		useminPrepare: {
			html: ['<%= app %>/index.html'],
			options: {
				dest: '<%= dist %>'
			}
		},

		usemin: {
			html: ['<%= dist %>/**/*.html', '!<%= app %>/components/**'],
			css: ['<%= dist %>/css/**/*.css'],
            js: ['<%= dist %>/js/**/*.js'],
			options: {
				dirs: ['<%= dist %>']
			}
		},

		watch: {
			grunt: {
				files: ['Gruntfile.js'],
				tasks: ['sass']
			},
			sass: {
				files: '<%= app %>/scss/**/*.scss',
				tasks: ['sass']
			},
			livereload: {
				files: ['!<%= app %>/components/**', '<%= app %>/js/**/*.js', '<%= app %>/css/**/*.css'],
				options: {
					livereload: true
				}
			}
		},

	});

	grunt.registerTask('compile-sass', ['sass']);
	grunt.registerTask('default', ['compile-sass', 'watch']);
	grunt.registerTask('validate-js', ['jshint']);
	grunt.registerTask('publish', ['compile-sass', 'clean:dist', 'concat', 'useminPrepare', 'copy:dist', 'newer:imagemin', 'cssmin', 'uglify', 'usemin']);
};
