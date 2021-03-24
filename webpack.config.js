const { resolve } = require('path')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const { CleanWebpackPlugin } = require('clean-webpack-plugin')
const WebpackAssetsManifest = require('webpack-assets-manifest')
const CopyWebpackPlugin = require('copy-webpack-plugin')

const source = resolve(__dirname, 'source')

module.exports = {

    context: source,
    devtool: 'source-map',
    stats: 'minimal',

    entry: {
        main: './scripts/main.js',
        panel: './scripts/panel.js'
    },

    output: {
        path: resolve(__dirname, 'public/assets'),
        filename: '[name].[contenthash].js',
        publicPath: '/assets/',
        sourceMapFilename: '[name][ext].map'
    },

    resolve: {
        alias: {
            '%': resolve(source, 'scripts'),
            '~': resolve(source, 'styles')
        }
    },

    cache: {
        type: 'filesystem',
        buildDependencies: { config: [__filename] }
    },

    plugins: [

        new MiniCssExtractPlugin({ filename: '[name].[contenthash].css' }),

        new CleanWebpackPlugin,

        new WebpackAssetsManifest({
            publicPath: true,
            contextRelativeKeys: true
        }),

        new CopyWebpackPlugin({
            patterns: [{
                context: 'static/',
                from: '**',
                to: 'static/[path][name].[contenthash].[ext]'
            }]
        })
    ],

    module: {
        rules: [

            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: [
                            ['@babel/preset-env', { bugfixes: true }]
                        ]
                    }
                }
            },

            {
                test: /\.(scss|css)$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: ['postcss-preset-env']
                            }
                        }
                    },
                    'sass-loader'
                ]
            }
        ]
    }
}