
module.exports = function (grunt) {
	require('load-grunt-tasks')(grunt);
	grunt.initConfig({
		// Import package manifest
		pkg: grunt.file.readJSON("package.json"),
		// Banner definitions
		bower: {
			dev: {
				dest: 'thirdparty/',
				options: {
					stripAffix: true,
					expand: true,
					keepExpandedHierarchy: false
				}
			}
		},
		concat: {
			options: {
				footer: 'jQuery.migrateMute = true;'
			},
			dist: {
				src: ['thirdparty/jquery/jquery.js'],
				dest: 'thirdparty/jquery/jquery.js'
			}
		},
		uglify: {
			jquery: {
				options: {
					sourceMap: true
				},
				files: {
					'thirdparty/jquery/jquery.min.js': ['thirdparty/jquery/jquery.js'],
					'thirdparty/jquery-migrate/jquery-migrate.min.js': ['thirdparty/jquery-migrate/jquery-migrate.js']
				}
			}
		},
		update_json: {
			options: {
				indent: "\t"
			},
			bower: {
				src: "package.json",
				dest: "bower.json",
				fields: [
					"name",
					"description",
					"license",
					"homepage",
					"keywords",
					{"authors": ["author"]},
					"repository",
					"private"
				]
			},
			composer: {
				src: "package.json",
				dest: "composer.json",
				fields: [
					{
						"name": function (src) {
							return "gdmedia/" + src.name;
						}
					},
					"description",
					"license",
					"homepage",
					"keywords",
					{"authors": ["author"]},
					{
						support: {
							"issues": "/bugs/url",
							"email": "/bugs/email"
						}
					}
				]
			}
		},
	});
	grunt.registerTask("default", ["bower_install", "bower", "concat", "uglify"]);
};
