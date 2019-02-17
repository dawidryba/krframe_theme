const path = require('path');
const webpack = require('webpack');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");

new webpack.EnvironmentPlugin(['NODE_ENV', 'DEBUG']);


const domain = 'http://medyczny.localhost/';

module.exports = env => {
    const devMode = env.NODE_ENV !== 'production';
    return {
        mode: env.NODE_ENV,
        entry: {
            main: [
                './_dev/js/main.js',
                './_dev/scss/main.scss'
            ]
        },
        output: {
            path: path.resolve(__dirname, 'assets/js'),
            filename: '[name].script.js'
        },
        module: {
            rules: [{
                    test: /\.js/,
                    exclude: /node_modules/,
                    loader: 'babel-loader',
                    query: {
                        presets: ['@babel/env'],
                    },
                },
                {
                    test: /\.scss$/,
                    use: [
                        devMode ? 'style-loader' : MiniCssExtractPlugin.loader,
                        'css-loader',
                        'postcss-loader',
                        'sass-loader'
                    ]
                },
                {
                    test: /.(png|jpg|woff(2)?|eot|ttf|svg)(\?[a-z0-9=\.]+)?$/,
                    use: [{
                        loader: 'file-loader',
                        options: {
                            name: '../css/[hash].[ext]'
                        }
                    }]
                },
                {
                    test: /\.css$/,
                    use: ['style-loader', 'css-loader', 'postcss-loader']
                }
            ]
        },
        externals: {
            $: '$',
            jquery: 'jQuery'
        },
        optimization: {
            minimizer: [
                new UglifyJsPlugin({
                    cache: true,
                    parallel: true,
                    sourceMap: true // set to true if you want JS source maps
                }),
                new OptimizeCSSAssetsPlugin({})
            ]
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: "../css/[name].min.css",
                chunkFilename: "[id].css"
            }),
            new BrowserSyncPlugin({
                host: 'localhost',
                port: 3000,
                proxy: domain,
                files: [
                    'twig/*.twig',
                    'twig/**/*.twig',
                    '*.php',
                ]
            })
        ]
    }
};
