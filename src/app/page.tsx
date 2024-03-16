import Label from '../components/form/Label';
import Input from '../components/form/Input';
import Button from '../components/Button';

function Login() {
  
  return (
    <main className="container flex items-center justify-center py-10">
      <div className="w-full md:w-1/2 xl:w-1/3">
        <div className="mx-5 md:mx-10">
          <h2 className="uppercase">ICT-Information</h2>
          <h4 className="uppercase">Rmutto</h4>
        </div>
        
        <form className="card mt-5 p-5 md:p-10" action="/">
          <div className="mb-5">
            <Label className="block mb-2" htmlFor="username">
              Username
            </Label>
            <Input id="username" placeholder="XXXXXXXXXXXX-X" />
          </div>

          <div className="mb-5">
            <Label className="block mb-2" htmlFor="password">
              Password
            </Label>
            <Input id="password" type="password" />
          </div>

          <div className="flex items-center">
            <Button className="mx-auto uppercase">
              Login
            </Button>
          </div>
        </form>
      </div>
    </main>
  );
}

export default Login;
