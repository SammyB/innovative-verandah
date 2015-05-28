module.exports = function(grunt) {

	// Innovative Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			compass: {
				files: ['sass/**/**/*.{scss,sass}'],
				tasks: ['compass:dev', 'cssmin']
			},
			js: {
				files: ['js/**/**/**/*.js','!js/main.min.js'],
				tasks: ['uglify']
			},
		},
		compass: {
			dev: {
				options: {
					sassDir: ['sass'],
					cssDir: ['css'],
					environment: 'development'
				}
			},
		},
		uglify: {
			all: {
				files: {
					'js/main.min.js': [
						'js/jquery.min.js',
						'js/bigSlide.min.js',
						'jquery.drawer.js',
						'jquery.easing.min.js',
						'js/iscroll-lite.min.js',
						'js/dropdown.min.js',
						'js/skel.min.js',
						'js/init.js',
					]
				}
			},
		},
		cssmin: {
			combine: {
				files: {
					'css/output.min.css': [
						'css/drawer/drawer.css',
						'css/skel.css',
						'css/style.css',
					]
				}
			}
		},
	});

	// Load the plugin
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	// Default task(s).
	grunt.registerTask('default', ['compass:dev' , 'cssmin', 'uglify', 'watch']);

};