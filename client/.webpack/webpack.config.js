/* eslint-disable import/no-extraneous-dependencies */
const path = require('path');

const AddAssetHtmlPlugin = require('add-asset-html-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CspHtmlWebpackPlugin = require('csp-html-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ServiceWorkerWebpackPlugin = require('serviceworker-webpack-plugin');
const webpack = require('webpack');

const join = path.join.bind(null, __dirname, '..');

module.exports = {
  context: join('src'),
  devServer: {
    clientLogLevel: 'error',
    compress: true,
    contentBase: join('dist'),
    historyApiFallback: true,
    host: '0.0.0.0',
    noInfo: true,
    port: 4000,
    proxy: {
      '/api': { changeOrigin: true, pathRewrite: { '^/api': '' }, target: 'http://api:80' },
    },
    publicPath: '/',
  },
  devtool: 'cheap-module-source-map',
  entry: ['@babel/polyfill', '../src/index.jsx', '../src/index.scss'],
  mode: 'development',
  module: {
    rules: [
      {
        exclude: [/node_modules/, /\.test\.jsx?$/],
        test: /\.jsx?$/,
        use: [{ loader: 'babel-loader' }],
      },
      { test: /\.scss$/, enforce: 'pre', loader: 'import-glob-loader2' },
      {
        exclude: [/node_modules/],
        test: /\.scss$/,
        use: [
          { loader: 'style-loader' },
          { loader: 'css-loader' },
          { loader: 'postcss-loader' },
          { loader: 'sass-loader', options: { includePaths: ['node_modules', 'src'] } },
        ],
      },
    ],
  },
  optimization: {
    splitChunks: {
      cacheGroups: {
        common: {
          chunks: 'async',
          enforce: true,
          minChunks: 2,
          name: 'common',
          priority: 10,
          reuseExistingChunk: true,
        },
        default: false,
        vendors: false,
      },
    },
  },
  output: {
    path: join('dist'),
    filename: '[name].js',
    publicPath: '/',
  },
  plugins: [
    new CopyWebpackPlugin([
      { from: 'assets', to: 'assets' },
      { from: 'google-analytics.js', to: 'google-analytics.js' },
      { from: 'manifest.webmanifest', to: 'manifest.webmanifest' },
    ]),
    new HtmlWebpackPlugin({ template: 'index.html' }),
    new CspHtmlWebpackPlugin({
      'base-uri': '\'self\'',
      'connect-src': ['\'self\'', 'wss://localhost:4000', 'wss://0.0.0.0:4000', 'https://fonts.googleapis.com', 'https://fonts.gstatic.com'],
      'default-src': '\'none\'',
      'font-src': ['\'self\'', 'https://fonts.googleapis.com', 'https://fonts.gstatic.com'],
      'form-action': '\'none\'',
      'frame-src': ['https://www.google.com'],
      'img-src': ['\'self\'', 'data:'],
      'manifest-src': ['\'self\''],
      'object-src': '\'none\'',
      'script-src': ['\'self\'', 'https://www.google.com', 'https://www.gstatic.com', 'https://www.google-analytics.com', 'https://www.googletagmanager.com/'],
      'style-src': ['\'self\'', '\'unsafe-inline\'', 'https://fonts.googleapis.com', 'https://fonts.gstatic.com'],
    }),
    new ServiceWorkerWebpackPlugin({
      entry: join('src', 'service-worker.js'),
      filename: 'service-worker.js',
    }),
    new webpack.DllReferencePlugin({
      context: join('src'),
      // eslint-disable-next-line global-require, import/no-dynamic-require
      manifest: require(join('dist', 'vendor-manifest.json')),
    }),
    new AddAssetHtmlPlugin({
      filepath: join('dist', 'vendor.js'),
      includeSourcemap: false,
    }),
  ],
  resolve: {
    extensions: ['.js', '.jsx'],
    modules: ['node_modules', 'src'],
  },
};
