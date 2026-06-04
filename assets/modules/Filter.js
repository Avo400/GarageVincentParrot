/**
 * @property {HTMLElement|null} pagination
 * @property {HTMLElement|null} content
 * @property {HTMLElement|null} sorting
 * @property {HTMLElement|null} form
 */

export default class Filter {
    
    /**
     * 
     * @param {HTMLElement|null} element 
     */
    constructor(element) {
        if (element === null) {

        console.log('toto dans le if');

            return
        }
        console.log('je me construis');
        this.pagination = element.querySelector('.js-filter-pagination');
        this.content = element.querySelector('.js-filter-content');
        this.sorting = element.querySelector('.js-filter-sorting');
        this.form = element.querySelector('.js-filter-form'); 
        this.bindEvents();
    }

    
    /**
     * Ajouter les comportements au différents eléments.
     */
            
     bindEvents() {
        const aClickListener = e => {
            if (e.target.tagName === 'A')    {
                e.preventDefault()
                this.loadUrl(e.target.getAttribute('href'))
            }
        }

        this.sorting.addEventListener('click', aClickListener)
         if (this.pagination) {
            this.pagination.addEventListener('click', aClickListener)
        } 


       this.form.querySelectorAll('input').forEach(input => {
            input.addEventListener('change',this.loadForm.bind(this))
       })
    } 

    async loadForm () {
        const data = new FormData(this.form);
        const url = new URL(this.form.getAttribute('action') || window.location.href);
        const params = new URLSearchParams();
        data.forEach((value, key) => {
            params.append(key, value)
        })
        return this.loadUrl(url.pathname + '?' + params.toString())
    }

    async loadUrl (url) {
        const ajaxUrl = url + '&ajax=1'
        const response = await fetch(ajaxUrl, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        // Condition pour que la requête s'est bien déroulée 
        if (response.status >= 200 && response.status < 300) {
            const data = await response.json()
            this.content.innerHTML = data.content;
            this.sorting.innerHTML = data.sorting;
            console.log('sorting', data.sorting);
            if (this.pagination) {
                this.pagination.innerHTML = data.pagination;
            }
            history.replaceState({}, '', url)
        } else {
            console.error(response)
        }
    }
}