const webpack = require('webpack');
const path = require('path');
const HashAssetsPlugin = require('hash-assets-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer').BundleAnalyzerPlugin;

// 输出到根目录下
const buildDir = path.resolve(process.cwd(), 'dist2');
const isProd = process.env.NODE_ENV === 'production';
const useSourcemaps = !isProd;
// 粗略通过命令行判断是否为热更新
// xx/node xx/webpack-dev-server --hot --progress
const isHot = process.argv[2] === '--hot';
// HMR不支持chunkhash，只支持hash，而HashAssetsPlugin不支持hash
const useVersioning = !isHot;
const publicPath = isProd ? '/dist2/' : 'http://localhost:8080/dist2/';

const styleLoader = {
  loader: 'style-loader',
  options: {
    sourceMap: useSourcemaps
  }
};

const cssLoader = {
  loader: 'css-loader',
  options: {
    sourceMap: useSourcemaps,
    minimize: isProd
  }
};

const sassLoader = {
  loader: 'sass-loader',
  options: {
    sourceMap: useSourcemaps
  }
};

const resolveUrlLoader = {
  loader: 'resolve-url-loader',
  options: {
    sourceMap: useSourcemaps
  }
};

let cssLoaders = ExtractTextPlugin.extract({
  use: cssLoader,
  fallback: styleLoader
});
if (isHot) {
  cssLoaders = ['css-hot-loader'].concat(cssLoaders);
}

let sassLoaders = ExtractTextPlugin.extract({
  use: [
    cssLoader,
    resolveUrlLoader,
    sassLoader
  ],
  fallback: styleLoader
});
if (isHot) {
  sassLoaders = ['css-hot-loader'].concat(sassLoaders);
}

function getEntries() {
  const entries = {};

  // 初始化通用的模块
  entries['job'] = [];

  // https://github.com/gaearon/react-hot-loader
  // entries['job'].push('react-hot-loader/patch');

  entries['job'].push('/Users/twin/data/web/miaostar/vendor/miaoxing/job/modules/containers/job.js');

  return entries;
}

const config = {
  resolve: {
    modules: [
      __dirname,
      'vendor/miaoxing/app/modules',
      'node_modules'
    ]
  },
  // NOTE: 需直接传入结果，不能使用回调函数，否则HMR不生效
  entry: getEntries(),
  output: {
    path: buildDir,
    publicPath: publicPath,
    filename: useVersioning ? '[name]-[chunkhash:6].js' : '[name].js',
    chunkFilename: useVersioning ? '[name]-[chunkhash:6].js' : '[name].js'
  },
  module: {
    loaders: [
      {
        test: /\.(js|jsx)?/,
        exclude: /node_modules/,
        loader: 'babel-loader'
      },
      {
        test: /\.css$/,
        use: cssLoaders,
      },
      {
        test: /\.scss$/,
        use: sassLoaders,
      },
      {
        test: /\.(jpg|png|gif|svg|json|ttf|eot|woff(2)?)(\?[a-z0-9]+)?$/,
        loader: 'file-loader',
        options: {
          // 只支持hash，相当于contenthash
          // https://github.com/webpack-contrib/file-loader/issues/177
          name: useVersioning ? '[path][name]-[hash:6].[ext]' : '[path][name].[ext]'
        }
      }
    ]
  },
  externals: {
    'jquery': 'jQuery'
  },
  plugins: [
    new webpack.optimize.CommonsChunkPlugin({
      async: 'async',
      children: true,
      minChunks: 2
    }),
    new webpack.optimize.CommonsChunkPlugin({
      name: 'job-manifest',
      minChunks: Infinity
    }),
    new ExtractTextPlugin({
      filename: useVersioning ? '[name]-[chunkhash:6].css' : '[name].css'
    }),
    isProd ? new webpack.HashedModuleIdsPlugin() : new webpack.NamedModulesPlugin(),
    // new BundleAnalyzerPlugin(),
  ],
  // https://webpack.js.org/configuration/devtool/
  devtool: isProd ? '' : 'eval',
  devServer: {
    headers: {
      'Access-Control-Allow-Origin': '*'
    }
  }
};

if (useVersioning) {
  config.plugins.push(
    new HashAssetsPlugin({
      filename: 'job-assets-hash.json',
      path: buildDir,
      hashLength: 6,
      prettyPrint: true,
      keyTemplate: function (filename) {
        var match = /(.+?)-\w{6}\.(js|css)$/.exec(filename);
        if (match) {
          return match[1] + '.' + match[2];
        } else {
          return filename;
        }
      }
    })
  );
}

if (isProd) {
  config.plugins.push(
    new UglifyJSPlugin({
      cache: true,
      parallel: true
    })
  );

  config.plugins.push(
    new webpack.LoaderOptionsPlugin({
      minimize: true,
      debug: false
    })
  );

  config.plugins.push(
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify('production')
    })
  );
}

module.exports = config;
