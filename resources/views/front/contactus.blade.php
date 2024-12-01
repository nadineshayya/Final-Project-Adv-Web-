@extends('front.layouts.app')

@section('content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('front.home')}}">Home</a></li>
                    <li class="breadcrumb-item">Contact Us</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            <div class="section-title mt-5">
                <h2>Love to Hear From You</h2>
            </div>   
        </div>
    </section>

    <section>
        <div class="container">          
            <div class="row">
                <div class="col-md-6 mt-3 pe-lg-5">
                    <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content.</p>
                    <address>
                        Lebanon <br>
                        Beirut<br> 
                        <a href="tel:+xxxxxxxx">+961 70 45 23 71</a><br>
                        <a href="mailto:thread&trend@gmail.com">thread&trend@gmail.com</a>
                    </address>                    
                </div>

                <div class="col-md-6">
                    <div id="successMessage" class="alert alert-success d-none">
                        Thank you! Your message has been sent.
                    </div>
                    <form id="contactForm">
                        <div class="mb-3">
                            <label class="mb-2" for="name">Name</label>
                            <input class="form-control" id="name" type="text" name="name">
                            <small class="text-danger d-none" id="nameError">Please enter your name.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="mb-2" for="email">Email</label>
                            <input class="form-control" id="email" type="email" name="email">
                            <small class="text-danger d-none" id="emailError">Please enter a valid email.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="mb-2" for="subject">Subject</label>
                            <input class="form-control" id="subject" type="text" name="subject">
                            <small class="text-danger d-none" id="subjectError">Please enter a subject.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="mb-2" for="message">Message</label>
                            <textarea class="form-control" id="message" rows="3" name="message"></textarea>
                            <small class="text-danger d-none" id="messageError">Please enter your message.</small>
                        </div>
                      
                        <div class="form-submit">
                            <button class="btn btn-dark" type="button" id="formSubmitButton">
                                <i class="material-icons mdi mdi-message-outline"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.getElementById('formSubmitButton').addEventListener('click', function() {
        let isValid = true;

  
        document.querySelectorAll('.text-danger').forEach(el => el.classList.add('d-none'));

   
        const nameField = document.getElementById('name');
        if (!nameField.value.trim()) {
            document.getElementById('nameError').classList.remove('d-none');
            isValid = false;
        }

 
        const emailField = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value.trim())) {
            document.getElementById('emailError').classList.remove('d-none');
            isValid = false;
        }

      
        const subjectField = document.getElementById('subject');
        if (!subjectField.value.trim()) {
            document.getElementById('subjectError').classList.remove('d-none');
            isValid = false;
        }

        const messageField = document.getElementById('message');
        if (!messageField.value.trim()) {
            document.getElementById('messageError').classList.remove('d-none');
            isValid = false;
        }

     
        if (isValid) {
            document.getElementById('successMessage').classList.remove('d-none');
          
            document.getElementById('contactForm').reset();

           
            setTimeout(() => {
                document.getElementById('successMessage').classList.add('d-none');
            }, 5000);
        }
    });
</script>
@endsection
