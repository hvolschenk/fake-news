/* eslint-disable import/no-extraneous-dependencies */
const path = require('path');

const AddAssetHtmlPlugin = require('add-asset-html-webpack-plugin');
const CompressionPlugin = require('compression-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const CspHtmlWebpackPlugin = require('csp-html-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const ServiceWorkerWebpackPlugin = require('serviceworker-webpack-plugin');
const webpack = require('webpack');

const join = path.join.bind(null, __dirname, '..');

module.exports = {
  context: join('src'),
  devtool: false,
  entry: ['@babel/polyfill', '../src/index.jsx', '../src/index.scss'],
  mode: 'production',
  module: {
    rules: [
      {
        exclude: [/node_modules/, /\.test\.jsx?$/],
        test: /\.jsx?$/,
        use: [{ loader: 'babel-loader' }],
      },
      {
        enforce: 'pre',
        exclude: [/node_modules/],
        loader: 'import-glob-loader2',
        test: /\.scss$/,
      },
      {
        exclude: [/node_modules/],
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
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
    path: join('build'),
    filename: '[name].js',
    publicPath: '/',
  },
  plugins: [
    new HtmlWebpackPlugin({ template: 'index.html' }),
    new CspHtmlWebpackPlugin({
      'base-uri': '\'self\'',
      'connect-src': ['\'self\'', 'https://fonts.googleapis.com', 'https://fonts.gstatic.com'],
      'default-src': '\'none\'',
      'font-src': ['\'self\'', 'https://fonts.googleapis.com', 'https://fonts.gstatic.com'],
      'form-action': '\'none\'',
      'frame-src': ['https://www.google.com'],
      'img-src': ['\'self\'', 'data:', 'https://www.google-analytics.com'],
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
      manifest: require(join('build', 'vendor-manifest.json')),
    }),
    new AddAssetHtmlPlugin({
      filepath: join('build', 'vendor.js'),
      includeSourcemap: false,
    }),
    new CopyWebpackPlugin([
      { from: 'assets', to: 'assets' },
      { from: 'manifest.webmanifest', to: 'manifest.webmanifest' },
      { from: 'robots.txt', to: 'robots.txt' },
    ]),
    new MiniCssExtractPlugin(),
    new CompressionPlugin(),
  ],
  resolve: {
    extensions: ['.js', '.jsx'],
    modules: ['node_modules', 'src'],
  },
};
