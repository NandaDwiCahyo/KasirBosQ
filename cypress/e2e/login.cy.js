describe('The Login Page', () => {
    it('Sets auth cookie when logging in via form submission', function () {
        // Destructing assignment of the this.currentUser object
        // const { email, password } = this.currentUser

        cy.visit('/login')

        cy.get('input[name=email]').type("nanda@email.test")

        // {enter} causes the form to submit
        cy.get('input[name=password]').type('password')

        // Button click after filling login form
        cy.get('.btn').click()

        // UI should reflect this user being logged in
        cy.get('.navbar-brand').should('contain', 'KasirBosQ')
    })
})