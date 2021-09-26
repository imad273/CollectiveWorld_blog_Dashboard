class App extends React.Component {
   render() {
      return (
         <div>
            <Header />
            <Footer />
         </div>
      )
   }
}
class Header extends React.Component {
   render() {
      return (
         <header>Header</header>
      )
   }
}

class Footer extends React.Component {
   render() {
      return (
         <footer>Footer</footer>
      )
   }
}

ReactDOM.render(<App />, document.getElementById('div'))