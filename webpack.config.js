const path = require('path')
const webpack = require('webpack')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin

module.exports = {
  entry: {
    dashboard: './resources/assets/js/dashboard.js'
  },
  output: {
    path: path.resolve(__dirname, './public/dist'),
    publicPath: '/dist/',
    filename: 'js/[name].js',
    chunkFilename: 'js/[name].[chunkhash].js'
  },
  module: {
    rules: [{
      test: /\.(js|vue)$/,
      loader: 'eslint-loader',
      enforce: 'pre',
      exclude: /node_modules/,
      options: {
        formatter: require('eslint-friendly-formatter'),
        quiet: true
      }
    }, {
      test: /\.vue$/,
      use: [{
        loader: 'vue-loader',
        options: {
          loaders: {
            // Since sass-loader (weirdly) has SCSS as its default parse mode, we map
            // the "scss" and "sass" values for the lang attribute to the right configs here.
            // other preprocessors should work out of the box, no loader config like this necessary.
            'scss': 'vue-style-loader!css-loader!sass-loader',
            'sass': 'vue-style-loader!css-loader!sass-loader?indentedSyntax'
          }
          // other vue-loader options go here
        }
      }]
    }, {
      test: /\.js$/,
      use: 'babel-loader',
      exclude: /node_modules/
    }, {
      test: /\.(png|jpg|gif|svg)$/,
      use: [{
        loader: 'file-loader',
        options: {
          name: '[name].[ext]?[hash]'
        }
      }]
    }, {
      test: /\.(eot|otf|svg|ttf|woff|woff2)$/,
      use: [{
        loader: 'file-loader',
        options: {
          name: 'fonts/[name].[ext]'
        }
      }]
    }]
  },
  resolve: {
    extensions: [ '.js', '.vue', '.scss' ],
    modules: [ 'node_modules', __dirname + '/resources/assets/' ],
    alias: {
      'vue$': 'vue/dist/vue.esm.js'
    },
  },
  devServer: {
    historyApiFallback: true,
    overlay: true,
    inline: true,
    headers: {
      'Access-Control-Allow-Origin': '*'
    }
  },
  performance: {
    hints: false
  },
  devtool: '#eval-source-map',
  plugins: [
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor',
      filename: 'js/vendor.js',
      minChunks: function (module) {
        return module.context &&
          module.context.indexOf('node_modules') !== -1 &&
          module.request && module.request.indexOf('.scss') == -1 &&
          module.request.indexOf('.css') == -1 
      }
    }),
    new webpack.ContextReplacementPlugin(/moment[\/\\]locale$/, /en/),
    new webpack.optimize.ModuleConcatenationPlugin()
  ]
}

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map'
  // http://vue-loader.vuejs.org/en/workflow/production.html
  module.exports.module.rules = (module.exports.module.rules || []).concat([
    {
      test: /\.scss$/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: [
          'css-loader',
          'postcss-loader',
          'sass-loader'
        ]
      })
    },
    {
      test: /\.css$/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: [
          'css-loader',
        ]
      })
    }
  ])
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    }),
    new ExtractTextPlugin('css/app.css')
  ])

  if (process.env.STATS === 'yes') {
    module.exports.plugins = (module.exports.plugins || []).concat([
      new BundleAnalyzerPlugin({ generateStatsFile: true, analyzerPort: 9002 })
    ])
  }
} else {
  module.exports.output.publicPath = 'http://localhost:8080/'
  module.exports.module.rules = (module.exports.module.rules || []).concat([
    {
      test: /\.scss$/,
      use: [
        { loader: 'style-loader' },
        { loader: 'css-loader' },
        { loader: 'postcss-loader' },
        { loader: 'sass-loader' }
      ]
    },
    {
      test: /\.css$/,
      use: [
        { loader: 'style-loader' },
        { loader: 'css-loader' },
      ]
    }
  ])
}
