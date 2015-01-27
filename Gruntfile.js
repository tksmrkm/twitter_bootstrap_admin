module.exports = function(grunt) {
    'use strict';
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        bower: {
            install: {
                options: {
                    targetDir: './webroot',
                    layout: 'byType',
                    install: true,
                    verbose: false,
                    cleanTargetDir: true,
                    cleanBowerDir: false
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-bower-task');
    grunt.registerTask
};