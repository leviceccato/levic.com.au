import Pjax from 'pjax'

export const createPjax = () => {

    const pjax = new Pjax({
        analytics: false,
        cacheBust: false,
        selectors: [
            '.js-title',
            '.js-description',
            '.js-main',
            '.js-footerFirst',
            '.js-footerLast'
        ]
    })
}