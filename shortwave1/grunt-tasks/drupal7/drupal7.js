module.exports = function (grunt, config) {
  "use strict";

  var infoFile = "shortwave.info";

  function getDrupalJS() {
    var drupalInfoJS = [];
    var info = grunt.file.read(infoFile);
    info.match(/^scripts.*/gm).forEach(function (line) {
      drupalInfoJS.push(line.replace(/^script.*= /, ''));
    });
    //console.log(drupalInfoJS);
    return drupalInfoJS;
  }

  function getDrupalCSS() {
    var drupalInfoCSS = [];
    var info = grunt.file.read(infoFile);
    info.match(/^stylesheets.*/gm).forEach(function (line) {
      drupalInfoCSS.push(line.replace(/^stylesheets.*= /, ''));
    });
    //console.log(drupalInfoCSS);
    return drupalInfoCSS;
  }

  grunt.registerTask("injectBowerComponents", [
    //"wiredep:drupal", // add any dependencies installed via `bower install {thing} --save` to our Drupal `infoFile`
    "injector:headCSS", // add any dependencies from the Drupal `infoFile` to our Pattern Lab
    "injector:footJS", // do that ^ for our JS
    "injector:footBowerJS"
  ]);
  
  grunt.config.merge({
    
    shell: {
      drupalCC: {
        command: "drush cc all"
      } 
    },

    // injector's job is to read the Drupal 7 theme.info file and inject those assets into PL
    injector: {
      // https://github.com/klei/grunt-injector
      options: {
        addRootSlash: false,
        ignorePath: []
      },
      headCSS: {
        options: {
          starttag: '<!-- start:headCSS -->',
          endtag: '<!-- end:headCSS -->',
          transform: function (filePath) {
            filePath = "../../../../" + filePath;
            return '<link rel="stylesheet" href="' + filePath + '" media="all" />';
          }
        },
        src: getDrupalCSS(),
        dest: config.plDir + 'source/_patterns/00-atoms/00-meta/_00-head.mustache'
      },
      footJS: {
        options: {
          starttag: '<!-- start:footJS -->',
          endtag: '<!-- end:footJS -->',
          transform: function (filePath) {
            filePath = "../../../../" + filePath; // @todo consider better pathing method 
            return '<script src="' + filePath + '"></script>';
          }
        },
        src: getDrupalJS(),
        dest: config.plDir + 'source/_patterns/00-atoms/00-meta/_01-foot.mustache'
      },
      footBowerJS: {
        options: {
          starttag: '<!-- start:footBowerJS -->',
          endtag: '<!-- end:footBowerJS -->',
          transform: function (filePath) {
            filePath = "../../../../" + filePath; // @todo consider better pathing method 
            return '<script src="' + filePath + '"></script>';
          }
        },
        src: 'bower.json',
        dest: config.plDir + 'source/_patterns/00-atoms/00-meta/_01-foot.mustache'
      }
    },

    // wiredep's job is to take assets declared by Bower and add them to the Drupal 7 theme.info file
    wiredep: {// https://github.com/stephenplusplus/grunt-wiredep
      options: {
        directory: 'bower_components'
      },
      drupal: {
        src: infoFile,
        devDependencies: true,
        dependencies: true,
        exclude: [],

        fileTypes: {
          info: {
            block: /(([ \t]*);\s*bower:*(\S*))(\n|\r|.)*?(;\s*endbower)/gi,
            detect: {
              js: /<script.*src=['"]([^'"]+)/gi,
              css: /<link.*href=['"]([^'"]+)/gi
            },
            replace: {
              js: 'scripts[] = {{filePath}}',
              css: 'stylesheets[] = {{filePath}}'
            }
          }
        }
      }
    },
    
    watch: {
      bower: {
        files: ['bower.json'],
        tasks: [
          'injectBowerComponents',
          'shell:drupalCC'
        ]
      }
    }

  });
};