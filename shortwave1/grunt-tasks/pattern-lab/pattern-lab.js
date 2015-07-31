module.exports = function (grunt, config) {
  "use strict";

  var scssDir = config.scssDir || "scss/";
  var plDir = config.plDir || "pattern-lab/";
  var serverPath = config.serverPath || "pattern-lab/public/";
  var serverDir = config.serverDir || "./";

  grunt.config.merge({
    shell: {
      plBuild: {
        command: "php " + plDir + "core/builder.php --generate --nocache"
      },
      livereload: {
        command: "touch .change-to-reload.txt"
      }
    },
    jsonlint: {
      pl: {
        src: [
          plDir + "source/_patterns/**/*.json",
          plDir + "source/_data/*.json"
        ]
      }
    },
    watch: {
      pl: {
        files: plDir + "source/**/*.*",
        tasks: [
          "shell:plBuild",
          "shell:livereload",
          "newer:jsonlint:pl"
        ]
      },
      livereload: {
        options: {
          livereload: true
        },
        files: ".change-to-reload.txt"
      }
    },
    // local server
    connect: { // https://www.npmjs.org/package/grunt-contrib-connect
      pl: {
        options: {
          port: 9005,
          useAvailablePort: true,
          base: serverDir,
          keepalive: true,
          livereload: true,
          open: "http://0.0.0.0:9005/" + serverPath
        }
      }
    },
    pattern_lab_component_builder: {
      colors: {
        options: {
          regex: "^\\$color--.*",
          allow_var_values: false
        },
        src: scssDir + 'project/_vars.scss',
        dest: plDir + 'source/_patterns/00-atoms/01-global/00-colors.json'
      }
      //fontSizes: {
      //  options: {
      //    regex: "^\\$font-size.*",
      //    allow_var_values: false
      //  },
      //  src: scssDir + 'global/_variable.scss',
      //  dest: plDir + "source/_patterns/00-atoms/02-text/00-font-sizes.json"
      //},
      //breakpoints: {
      //  options: {
      //    regex: '^\\$bp.*',
      //    allow_var_values: false
      //  },
      //  src: scssDir + 'global/_variable.scss',
      //  dest: plDir + "source/_patterns/01-molecules/01-layout/99-breakpoints.json"
      //}
    }
  });

};