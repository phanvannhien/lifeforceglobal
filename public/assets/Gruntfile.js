/*
module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'style.css' : 'sass/bootstrap.scss'
        }
      }
    },
    watch: {
      css: {
        files: '*.scss',
        tasks: ['sass']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.registerTask('default',['sass','watch']);
}
*/


module.exports = function(grunt) {
 grunt.initConfig({
   sass: {
      dist: {
        files: {
          'style.css' : 'scss/bootstrap.scss'
        }
      }
    },
    watch: {
      css: {
        files: '*.scss',
        tasks: ['sass']
      }
    }
    /*
     concat: {
        gopcss: {
           src: [
              'bootstrap.css',
              'common.css'
           ],
           dest: 'style.css'
        },
        
        gopjs: {
           src: [
              'js/jquery/jquery-1.10.1.min.js',
              'js/bootstrap.min.js',
              'main.js'
              
           ],
           dest: 'app.js'
        },
     },
     cssmin: {
        nencss: {
           src: 'style.css',
           dest: 'style.min.css'
        },
        
     },
     uglify: {
        nenjs: {
           src: 'app.js',
           dest: 'app.min.js',
        }
     }*/
 });
  
 grunt.loadNpmTasks('grunt-contrib-sass');
 grunt.loadNpmTasks('grunt-contrib-watch');
 grunt.registerTask('default',['sass','watch']);

  
 //grunt.loadNpmTasks('grunt-contrib-concat');
 //grunt.loadNpmTasks('grunt-contrib-cssmin');
 //grunt.loadNpmTasks('grunt-contrib-uglify');
 //grunt.registerTask('default', ['concat', 'cssmin', 'uglify']);
};