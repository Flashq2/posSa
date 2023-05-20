<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permission Not Responce</title>
</head>
<style>
  body
  {
    background-color: #A59A9F;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpolygon fill='%23978f9c' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23888499' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%237a7996' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%236b6e93' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%235D6390' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
background-attachment: fixed;
background-size: cover;
  }





    *{
         font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
    }

    .card {
  overflow: hidden;
  position: absolute;
 top: 50%;
 left: 50%;
 transform: translate(-50% ,-50%);
  background-color: #261919;
  text-align: left;
  border-radius: 0.5rem;
  max-width: 500px;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

.header {
  padding: 1.25rem 1rem 1rem 1rem;
  background-color: rgba(0, 217, 255, 0.818);
}

.image {
  display: flex;
  margin-left: auto;
  margin-right: auto;
  background-color: #FEE2E2;
  flex-shrink: 0;
  justify-content: center;
  align-items: center;
  width: 3rem;
  height: 3rem;
  border-radius: 9999px;
}

.image svg {
  color: #DC2626;
  width: 1.5rem;
  height: 1.5rem;
}

.content {
  margin-top: 0.75rem;
  text-align: center;
}

.title {
  color: #ffffff;
  font-size: 1rem;
  font-weight: 600;
  line-height: 1.5rem;
}

.message {
  margin-top: 0.5rem;
  color: #ffffff;
  font-size: 0.875rem;
  line-height: 1.25rem;
}

.actions {
  margin: 0.75rem 1rem;
  background-color: ;
}

.desactivate {
  display: inline-flex;
  padding: 0.5rem 1rem;
  background-color: #2926dc;
  color: #ffffff;
  font-size: 1rem;
  line-height: 1.5rem;
  font-weight: 500;
  justify-content: center;
  width: 100%;
  border-radius: 0.375rem;
  border-width: 1px;
  border-color: transparent;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
.desactivate a{
    color: white;
}

.cancel {
  display: inline-flex;
  margin-top: 0.75rem;
  padding: 0.5rem 1rem;
  background-color: #ffffff;
  color: #374151;
  font-size: 1rem;
  line-height: 1.5rem;
  font-weight: 500;
  justify-content: center;
  width: 100%;
  border-radius: 0.375rem;
  border: 1px solid #D1D5DB;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}
</style>
<body>
    <div class="card">
        <div class="header">
          <div class="image"><svg aria-hidden="true" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" fill="none">
                      <path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" stroke-linejoin="round" stroke-linecap="round"></path>
                    </svg></div>
          <div class="content">
             <span class="title">Restricted User</span>
             <p class="message">
                Bases on user role and permission ,you can not access to this page 
                If you want to make any change you can contact to your Admin
             </p>
          </div>
           <div class="actions">
           <button class="desactivate" type="button"><a href="dashboard">Return Back</a></button>
          </div>
        </div>
        </div>
</body>
</html>