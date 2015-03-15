
module.exports = function (grunt) {
    require('load-grunt-tasks')(grunt); // load all grunt tasks. Done!

//    grunt.loadNpmTasks('grunt-bower-install-task');
//    grunt.loadNpmTasks('grunt-bower');
//    grunt.loadNpmTasks("grunt-contrib-uglify");
//    require('load-grunt-tasks')(grunt); // load all grunt tasks. Done!

//    require('load-grunt-tasks')(grunt);
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
                footer: 'jQuery.migrateMute = true;',
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
                    'thirdparty/jquery/jquery.min.js': ['thirdparty/jquery/jquery.js']
                }
            }
        }
    });
    grunt.registerTask("default", ["bower_install", "bower", "concat", "uglify"]);
};
