@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex gap-3 font-light group-hover:text-indigo-500 text-white px-4 py-3 items-center'
            : 'flex gap-3 text-white group-hover:text-indigo-500 px-4 py-3 items-center';
$classIcon = $icon . ' text-2xl leading-none';

@endphp

<!-- al modificar el estpan por un objeto modifica los botones de login y inicio de sesion y las clases de fontawesome-->
<a {{ $attributes->merge(['class' => $classes]) }}> 

    @switch($icon)
        @case('dashboard')
            <svg width="45" height="45" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.8582 49.9976C39.0434 50.0089 39.229 49.9806 39.4025 49.9147C39.5761 49.8489 39.7337 49.747 39.8649 49.6157C39.9962 49.4844 40.0981 49.3266 40.1639 49.1529C40.2297 48.9792 40.2579 48.7936 40.2467 48.6083V40.2761H48.5734C48.7589 40.2812 48.9435 40.249 49.1163 40.1815C49.2892 40.114 49.4467 40.0124 49.5797 39.883C49.7127 39.7535 49.8184 39.5987 49.8905 39.4277C49.9627 39.2567 49.9999 39.0729 49.9999 38.8872C49.9999 38.7016 49.9627 38.5178 49.8905 38.3468C49.8184 38.1757 49.7127 38.0208 49.5797 37.8913C49.4467 37.7619 49.2892 37.6605 49.1163 37.5929C48.9435 37.5254 48.7589 37.4933 48.5734 37.4984H40.2467V29.1662C40.2467 28.798 40.1005 28.4448 39.8403 28.1844C39.5801 27.9241 39.2272 27.7778 38.8592 27.7778C38.4912 27.7778 38.1383 27.9241 37.8781 28.1844C37.6179 28.4448 37.4718 28.798 37.4718 29.1662V37.4984H29.145C28.9595 37.4933 28.7749 37.5254 28.6021 37.5929C28.4293 37.6605 28.2717 37.7619 28.1387 37.8913C28.0057 38.0208 27.9 38.1757 27.8279 38.3468C27.7557 38.5178 27.7185 38.7016 27.7185 38.8872C27.7185 39.0729 27.7557 39.2567 27.8279 39.4277C27.9 39.5987 28.0057 39.7535 28.1387 39.883C28.2717 40.0124 28.4293 40.114 28.6021 40.1815C28.7749 40.249 28.9595 40.2812 29.145 40.2761H37.4718V48.6083C37.4604 48.7935 37.4884 48.9791 37.554 49.1527C37.6197 49.3262 37.7214 49.4839 37.8524 49.6152C37.9835 49.7465 38.1409 49.8486 38.3143 49.9145C38.4876 49.9804 38.673 50.0087 38.8582 49.9976V49.9976Z"/>
                <path d="M1.38888 49.9975H20.8194C21.0045 50.0085 21.1898 49.98 21.3631 49.914C21.5364 49.848 21.6937 49.746 21.8247 49.6147C21.9558 49.4834 22.0575 49.3258 22.1231 49.1523C22.1888 48.9788 22.217 48.7934 22.2058 48.6082V29.1661C22.2168 28.981 22.1886 28.7956 22.1228 28.6222C22.0571 28.4488 21.9553 28.2914 21.8243 28.1602C21.6933 28.029 21.536 27.9271 21.3628 27.8611C21.1896 27.7952 21.0044 27.7668 20.8194 27.7777H1.38888C1.20383 27.7666 1.01853 27.7949 0.845232 27.8608C0.67193 27.9266 0.514565 28.0286 0.383531 28.1598C0.252498 28.291 0.150776 28.4485 0.0850881 28.6219C0.0194006 28.7954 -0.00875822 28.9809 0.00246975 29.1661V48.6082C-0.00891175 48.7934 0.0191337 48.979 0.0847526 49.1526C0.150371 49.3262 0.25207 49.4838 0.38312 49.6151C0.514171 49.7464 0.671589 49.8485 0.844968 49.9144C1.01835 49.9803 1.20374 50.0086 1.38888 49.9975V49.9975ZM2.77736 30.5555H19.4309V47.2198H2.77736V30.5555Z"/>
                <path d="M27.7566 1.39272V20.8358C27.7453 21.0212 27.7735 21.2069 27.8393 21.3806C27.9051 21.5543 28.007 21.7119 28.1383 21.8433C28.2695 21.9746 28.4271 22.0766 28.6007 22.1424C28.7742 22.2083 28.9598 22.2364 29.145 22.2252H48.5735C48.7587 22.2364 48.9443 22.2083 49.1178 22.1424C49.2914 22.0766 49.449 21.9746 49.5802 21.8433C49.7115 21.7119 49.8134 21.5543 49.8792 21.3806C49.945 21.2069 49.9732 21.0212 49.9619 20.8358V1.39374C49.9732 1.20835 49.945 1.02274 49.8792 0.849076C49.8134 0.675409 49.7115 0.517621 49.5802 0.386291C49.449 0.25496 49.2914 0.152977 49.1178 0.087133C48.9443 0.0212887 48.7587 -0.00688323 48.5735 0.00436567H29.145C28.9599 -0.00686865 28.7744 0.0213502 28.6009 0.087133C28.4275 0.152916 28.2699 0.254821 28.1387 0.386036C28.0075 0.517252 27.9055 0.674773 27.8397 0.848313C27.7738 1.02185 27.7455 1.20742 27.7566 1.39272V1.39272ZM30.5325 2.78209H47.186V19.4464H30.5325V2.78209Z"/>
                <path d="M1.38888 22.2232H20.8194C21.0045 22.2341 21.1898 22.2056 21.3631 22.1396C21.5364 22.0736 21.6937 21.9716 21.8247 21.8403C21.9558 21.709 22.0575 21.5515 22.1231 21.3779C22.1888 21.2044 22.217 21.019 22.2058 20.8338V1.39172C22.217 1.20652 22.1888 1.02096 22.1231 0.847444C22.0575 0.673931 21.9558 0.516337 21.8247 0.38504C21.6937 0.253743 21.5364 0.151737 21.3631 0.0857554C21.1898 0.0197739 21.0045 -0.00858966 20.8194 0.00235232H1.38888C1.20374 -0.00875862 1.01835 0.0195792 0.844968 0.0855011C0.671589 0.151423 0.514171 0.253326 0.38312 0.384659C0.25207 0.515991 0.150371 0.673727 0.0847526 0.847317C0.0191337 1.02091 -0.00891175 1.20648 0.00246975 1.39172V20.8358C-0.00860485 21.0209 0.0196695 21.2063 0.0854256 21.3796C0.151182 21.5529 0.252923 21.7104 0.38394 21.8415C0.514957 21.9726 0.672269 22.0743 0.845494 22.1401C1.01872 22.2059 1.20392 22.2342 1.38888 22.2232V22.2232ZM2.77736 2.7811H19.4309V19.4454H2.77736V2.7811Z"/>
            </svg>
            @break

        @case('recibidos')
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M45.1337 6.49208H4.8709C3.62064 6.45587 2.40765 6.95269 1.49556 7.87462C0.583477 8.79655 0.0460154 10.0691 0 11.4156C0.0202238 12.3413 0.284941 13.2417 0.763133 14.0111C1.24132 14.7806 1.91318 15.3873 2.69997 15.7601V36.0997C2.72493 38.0862 3.47927 39.9812 4.79794 41.3699C6.11661 42.7586 7.89221 43.5281 9.73622 43.5099H40.2721C42.1159 43.5273 43.8911 42.7576 45.2096 41.369C46.5281 39.9805 47.2827 38.0859 47.3084 36.0997V15.7541C48.0928 15.3809 48.7624 14.775 49.239 14.0071C49.7156 13.2392 49.9796 12.341 50 11.4176C49.9549 10.0714 49.4185 8.7989 48.5072 7.87657C47.596 6.95425 46.3837 6.45669 45.1337 6.49208V6.49208ZM44.549 36.0978C44.547 36.6974 44.4344 37.2906 44.2177 37.8428C44.001 38.3951 43.6846 38.8954 43.2868 39.3147C42.889 39.734 42.4178 40.0639 41.9006 40.2853C41.3834 40.5067 40.8304 40.6151 40.274 40.6042H9.73808C9.18172 40.6158 8.6288 40.5079 8.11161 40.2866C7.59443 40.0654 7.12334 39.7354 6.72586 39.3158C6.32839 38.8963 6.01249 38.3956 5.79663 37.8431C5.58076 37.2905 5.46926 36.6973 5.46862 36.0978V16.5499H44.5481L44.549 36.0978ZM45.1337 13.4374H4.8709C4.60603 13.471 4.33755 13.4438 4.08313 13.3577C3.82871 13.2715 3.59412 13.1282 3.39479 12.9373C3.19547 12.7464 3.03593 12.5121 2.92668 12.25C2.81744 11.9879 2.76095 11.7039 2.76095 11.4166C2.76095 11.1293 2.81744 10.8452 2.92668 10.5831C3.03593 10.3209 3.19547 10.0868 3.39479 9.89588C3.59412 9.70498 3.82871 9.56171 4.08313 9.47552C4.33755 9.38933 4.60603 9.36217 4.8709 9.39581H45.1337C45.3986 9.36217 45.6671 9.38933 45.9215 9.47552C46.1759 9.56171 46.4105 9.70498 46.6099 9.89588C46.8092 10.0868 46.9687 10.3209 47.078 10.5831C47.1872 10.8452 47.2437 11.1293 47.2437 11.4166C47.2437 11.7039 47.1872 11.9879 47.078 12.25C46.9687 12.5121 46.8092 12.7464 46.6099 12.9373C46.4105 13.1282 46.1759 13.2715 45.9215 13.3577C45.6671 13.4438 45.3986 13.471 45.1337 13.4374V13.4374Z"/>
                <path d="M21.9169 30.744C22.0162 30.9228 22.1461 31.0774 22.299 31.1991C22.452 31.3207 22.625 31.4069 22.8079 31.4525C22.9908 31.4982 23.1799 31.5024 23.3643 31.465C23.5487 31.4275 23.7246 31.3491 23.8817 31.2344L33.3688 24.3024C33.6224 24.1222 33.8157 23.8523 33.9183 23.5353C34.0209 23.2182 34.027 22.8718 33.9357 22.5503C33.8444 22.2289 33.6609 21.9507 33.4138 21.7592C33.1668 21.5678 32.8702 21.474 32.5707 21.4925C32.3038 21.5004 32.0443 21.5931 31.8222 21.7599L23.5552 27.7995L21.5904 24.1709C21.5009 23.9906 21.3805 23.8321 21.236 23.7047C21.0915 23.5773 20.9259 23.4835 20.7489 23.4289C20.5718 23.3742 20.3869 23.3597 20.2049 23.3862C20.0228 23.4128 19.8473 23.48 19.6885 23.5837C19.5297 23.6874 19.3909 23.8255 19.2801 23.9901C19.1694 24.1548 19.0888 24.3426 19.0433 24.5427C18.9977 24.7427 18.988 24.951 19.0147 25.1553C19.0415 25.3596 19.1041 25.5559 19.199 25.7326L21.9169 30.744Z"/>
            </svg>
            @break

        @case('documentos')
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M44.2655 4.50802C44.2799 3.92217 44.1768 3.33941 43.9623 2.79383C43.7478 2.24826 43.4262 1.75097 43.0163 1.33105C42.6064 0.911134 42.1166 0.57699 41.5756 0.348438C41.0345 0.119886 40.4531 0.00141826 39.8655 0H16.2965C16.2765 0 16.2575 0.0110555 16.2375 0.0120529C16.0575 0.00805107 15.8786 0.0407732 15.7118 0.108354C15.5449 0.175935 15.3938 0.276865 15.2675 0.404928L6.13653 9.76211L6.12753 9.77306C6.01575 9.89086 5.926 10.0277 5.86253 10.177C5.84539 10.2189 5.83103 10.2618 5.81953 10.3056C5.77941 10.4211 5.75519 10.5416 5.74753 10.6636C5.74753 10.6946 5.73153 10.7205 5.73153 10.7504V45.493C5.71711 46.6721 6.17226 47.8089 6.99713 48.6539C7.822 49.4988 8.94923 49.9829 10.1315 50H39.8675C40.455 49.9986 41.0363 49.8802 41.5773 49.6517C42.1183 49.4232 42.6081 49.0892 43.0179 48.6694C43.4278 48.2496 43.7494 47.7524 43.964 47.2069C44.1786 46.6614 44.2818 46.0787 44.2675 45.493L44.2655 4.50802ZM14.8725 4.78037V6.79393C14.8805 7.12897 14.8214 7.46229 14.6986 7.77423C14.5758 8.08618 14.3917 8.37052 14.1573 8.61063C13.9229 8.85074 13.6428 9.04173 13.3334 9.17249C13.024 9.30325 12.6916 9.37119 12.3555 9.37215H10.3555L14.8725 4.78037ZM41.5645 45.4979C41.5727 45.7248 41.5346 45.951 41.4526 46.1628C41.3706 46.3746 41.2464 46.5677 41.0875 46.7303C40.9286 46.8928 40.7383 47.0216 40.5281 47.1088C40.3179 47.1959 40.0922 47.2396 39.8645 47.2373H10.1265C9.67175 47.2256 9.23952 47.0373 8.92197 46.7124C8.60442 46.3875 8.42664 45.9517 8.42654 45.4979V12.1387H12.3545C13.0512 12.1367 13.7405 11.9959 14.3819 11.7248C15.0234 11.4536 15.6041 11.0575 16.0901 10.5597C16.5761 10.0618 16.9575 9.47219 17.2121 8.82539C17.4666 8.1786 17.5892 7.4876 17.5725 6.79296V2.76669H39.8675C40.0953 2.76438 40.3211 2.80815 40.5313 2.89537C40.7416 2.98259 40.932 3.11144 41.0909 3.27412C41.2498 3.43681 41.374 3.62991 41.4559 3.84183C41.5378 4.05374 41.5758 4.28007 41.5675 4.50705L41.5645 45.4979Z"/>
                <path d="M37.7144 30.4771H12.3554C11.9938 30.4867 11.6504 30.6368 11.3981 30.8952C11.1458 31.1537 11.0046 31.5002 11.0046 31.8609C11.0046 32.2217 11.1458 32.5681 11.3981 32.8265C11.6504 33.085 11.9938 33.235 12.3554 33.2447H37.7144C38.0759 33.235 38.4194 33.085 38.6717 32.8265C38.924 32.5681 39.0651 32.2217 39.0651 31.8609C39.0651 31.5002 38.924 31.1537 38.6717 30.8952C38.4194 30.6368 38.0759 30.4867 37.7144 30.4771V30.4771Z"/>
                <path d="M12.3554 16.4184H19.8654C20.2269 16.4087 20.5704 16.2587 20.8227 16.0002C21.075 15.7418 21.2161 15.3954 21.2161 15.0346C21.2161 14.6739 21.075 14.3274 20.8227 14.069C20.5704 13.8105 20.2269 13.6606 19.8654 13.6509H12.3554C11.9938 13.6606 11.6504 13.8105 11.3981 14.069C11.1458 14.3274 11.0046 14.6739 11.0046 15.0346C11.0046 15.3954 11.1458 15.7418 11.3981 16.0002C11.6504 16.2587 11.9938 16.4087 12.3554 16.4184V16.4184Z"/>
                <path d="M37.7144 20.0376H12.3554C11.9938 20.0473 11.6504 20.1973 11.3981 20.4558C11.1458 20.7143 11.0046 21.0607 11.0046 21.4214C11.0046 21.7821 11.1458 22.1286 11.3981 22.3871C11.6504 22.6455 11.9938 22.7956 12.3554 22.8053H37.7144C38.0759 22.7956 38.4194 22.6455 38.6717 22.3871C38.924 22.1286 39.0651 21.7821 39.0651 21.4214C39.0651 21.0607 38.924 20.7143 38.6717 20.4558C38.4194 20.1973 38.0759 20.0473 37.7144 20.0376V20.0376Z"/>
                <path d="M37.7107 40.9902H31.2607C30.8991 40.9999 30.5556 41.15 30.3034 41.4084C30.0511 41.6669 29.9099 42.0133 29.9099 42.374C29.9099 42.7347 30.0511 43.0812 30.3034 43.3397C30.5556 43.5982 30.8991 43.7482 31.2607 43.7579H37.7107C38.0722 43.7482 38.4157 43.5982 38.668 43.3397C38.9202 43.0812 39.0614 42.7347 39.0614 42.374C39.0614 42.0133 38.9202 41.6669 38.668 41.4084C38.4157 41.15 38.0722 40.9999 37.7107 40.9902V40.9902Z"/>
                <path d="M37.7144 25.2959H12.3554C11.9938 25.3056 11.6504 25.4556 11.3981 25.7141C11.1458 25.9726 11.0046 26.3191 11.0046 26.6798C11.0046 27.0405 11.1458 27.3869 11.3981 27.6454C11.6504 27.9038 11.9938 28.0539 12.3554 28.0636H37.7144C38.0759 28.0539 38.4194 27.9038 38.6717 27.6454C38.924 27.3869 39.0651 27.0405 39.0651 26.6798C39.0651 26.3191 38.924 25.9726 38.6717 25.7141C38.4194 25.4556 38.0759 25.3056 37.7144 25.2959V25.2959Z"/>
                <path d="M37.7144 35.7339H12.3554C11.9938 35.7436 11.6504 35.8936 11.3981 36.1521C11.1458 36.4105 11.0046 36.7569 11.0046 37.1177C11.0046 37.4784 11.1458 37.8249 11.3981 38.0833C11.6504 38.3418 11.9938 38.4917 12.3554 38.5014H37.7144C38.0759 38.4917 38.4194 38.3418 38.6717 38.0833C38.924 37.8249 39.0651 37.4784 39.0651 37.1177C39.0651 36.7569 38.924 36.4105 38.6717 36.1521C38.4194 35.8936 38.0759 35.7436 37.7144 35.7339V35.7339Z"/>
            </svg>            
            @break
            
        @case('plantillas')
            <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40.884 0.117913C40.7093 0.0786863 40.5285 0.0743979 40.3521 0.105497C40.1757 0.136596 40.0073 0.202449 39.8566 0.29905C39.706 0.395651 39.5761 0.521143 39.4745 0.668263C39.373 0.815383 39.3017 0.981222 39.265 1.15604C39.1821 1.50997 39.2417 1.8822 39.4312 2.19271C39.6206 2.50322 39.9247 2.72711 40.278 2.81634C40.5285 2.875 40.7617 2.99125 40.9591 3.15573C41.1565 3.32021 41.3126 3.52845 41.415 3.76378C41.5191 4.00378 41.6911 4.20832 41.9099 4.35247C42.1287 4.49663 42.3848 4.57412 42.647 4.57549C42.8392 4.57557 43.0291 4.53332 43.203 4.45181C43.5328 4.29454 43.7879 4.01492 43.9136 3.6726C44.0394 3.33028 44.0259 2.95239 43.876 2.61987C43.6074 1.99911 43.1969 1.44962 42.6774 1.0152C42.1579 0.580774 41.5438 0.273534 40.884 0.117913V0.117913Z"/>
                <path d="M24.021 0.000976562H21.2589C20.8974 0.0106565 20.5539 0.160574 20.3017 0.419003C20.0494 0.677433 19.9082 1.02391 19.9082 1.38458C19.9082 1.74525 20.0494 2.09173 20.3017 2.35016C20.5539 2.60858 20.8974 2.7585 21.2589 2.76818H24.021C24.3825 2.7585 24.726 2.60858 24.9782 2.35016C25.2305 2.09173 25.3717 1.74525 25.3717 1.38458C25.3717 1.02391 25.2305 0.677433 24.9782 0.419003C24.726 0.160574 24.3825 0.0106565 24.021 0.000976562V0.000976562Z"/>
                <path d="M33.6859 0.000976562H30.9259C30.5644 0.0106565 30.2209 0.160574 29.9686 0.419003C29.7164 0.677433 29.5752 1.02391 29.5752 1.38458C29.5752 1.74525 29.7164 2.09173 29.9686 2.35016C30.2209 2.60858 30.5644 2.7585 30.9259 2.76818H33.6859C34.0475 2.7585 34.391 2.60858 34.6432 2.35016C34.8955 2.09173 35.0367 1.74525 35.0367 1.38458C35.0367 1.02391 34.8955 0.677433 34.6432 0.419003C34.391 0.160574 34.0475 0.0106565 33.6859 0.000976562V0.000976562Z"/>
                <path d="M42.9189 8.84131C42.556 8.8463 42.2099 8.99485 41.9567 9.25422C41.7036 9.51359 41.5641 9.86263 41.5689 10.2245V13.0536C41.5619 13.2347 41.5916 13.4155 41.6563 13.585C41.721 13.7544 41.8193 13.909 41.9454 14.0396C42.0714 14.1702 42.2226 14.2742 42.3899 14.3452C42.5572 14.4161 42.7371 14.4528 42.9189 14.4528C43.1007 14.4528 43.2806 14.4161 43.4479 14.3452C43.6151 14.2742 43.7663 14.1702 43.8924 14.0396C44.0184 13.909 44.1167 13.7544 44.1814 13.585C44.2461 13.4155 44.2759 13.2347 44.2689 13.0536V10.2215C44.2731 9.86003 44.1334 9.51166 43.8802 9.25288C43.6271 8.9941 43.2813 8.84604 42.9189 8.84131V8.84131Z"/>
                <path d="M17.578 1.38413C17.5801 1.1132 17.5022 0.847652 17.3541 0.62051C17.206 0.393368 16.9942 0.214658 16.745 0.106681C16.4983 0.000968943 16.2251 -0.0270106 15.962 0.0264595C15.6989 0.0799297 15.4585 0.212343 15.273 0.405897L6.12698 9.77985C6.01589 9.89778 5.92682 10.0345 5.86398 10.1836C5.84617 10.2255 5.83114 10.2685 5.81898 10.3123C5.77887 10.4289 5.75465 10.5504 5.74698 10.6734C5.74698 10.7023 5.73098 10.7292 5.73098 10.7581V12.1402C5.72399 12.3214 5.75373 12.502 5.81842 12.6715C5.88311 12.8409 5.98143 12.9956 6.10748 13.1263C6.23353 13.2569 6.38472 13.3607 6.55199 13.4317C6.71927 13.5027 6.89919 13.5393 7.08098 13.5393C7.26277 13.5393 7.44269 13.5027 7.60997 13.4317C7.77724 13.3607 7.92843 13.2569 8.05448 13.1263C8.18053 12.9956 8.27885 12.8409 8.34354 12.6715C8.40823 12.502 8.43797 12.3214 8.43098 12.1402H12.359C13.0557 12.1382 13.7449 11.9975 14.3864 11.7263C15.0278 11.4552 15.6086 11.0592 16.0945 10.5614C16.5805 10.0636 16.9619 9.47402 17.2165 8.8273C17.4711 8.18058 17.5936 7.48967 17.577 6.79511L17.578 1.38413ZM12.36 9.37095H10.341L13.771 5.85668C13.8202 5.8271 13.867 5.79379 13.911 5.75698L14.877 4.7757V6.78914C14.8856 7.12451 14.827 7.45823 14.7045 7.77067C14.582 8.0831 14.398 8.36789 14.1635 8.60842C13.929 8.84896 13.6487 9.04037 13.339 9.17131C13.0292 9.30225 12.6964 9.37013 12.36 9.37095V9.37095Z"/>
                <path d="M8.43196 19.2125C8.43895 19.0314 8.40921 18.8507 8.34452 18.6813C8.27982 18.5119 8.18151 18.3573 8.05546 18.2266C7.92941 18.096 7.77822 17.9921 7.61095 17.9211C7.44367 17.8501 7.26375 17.8135 7.08196 17.8135C6.90017 17.8135 6.72025 17.8501 6.55297 17.9211C6.38569 17.9921 6.2345 18.096 6.10845 18.2266C5.98241 18.3573 5.88409 18.5119 5.8194 18.6813C5.7547 18.8507 5.72496 19.0314 5.73196 19.2125V22.0417C5.72496 22.2229 5.7547 22.4035 5.8194 22.5729C5.88409 22.7424 5.98241 22.897 6.10845 23.0276C6.2345 23.1582 6.38569 23.2622 6.55297 23.3332C6.72025 23.4041 6.90017 23.4408 7.08196 23.4408C7.26375 23.4408 7.44367 23.4041 7.61095 23.3332C7.77822 23.2622 7.92941 23.1582 8.05546 23.0276C8.18151 22.897 8.27982 22.7424 8.34452 22.5729C8.40921 22.4035 8.43895 22.2229 8.43196 22.0417V19.2125Z"/>
                <path d="M42.9189 28.6455C42.556 28.6505 42.2099 28.7989 41.9567 29.0583C41.7036 29.3177 41.5641 29.6667 41.5689 30.0286V32.8547C41.5619 33.0359 41.5916 33.2166 41.6563 33.386C41.721 33.5554 41.8193 33.7101 41.9454 33.8408C42.0714 33.9714 42.2226 34.0753 42.3899 34.1463C42.5572 34.2173 42.7371 34.2538 42.9189 34.2538C43.1007 34.2538 43.2806 34.2173 43.4479 34.1463C43.6151 34.0753 43.7663 33.9714 43.8924 33.8408C44.0184 33.7101 44.1167 33.5554 44.1814 33.386C44.2461 33.2166 44.2759 33.0359 44.2689 32.8547V30.0286C44.2714 29.8494 44.2385 29.6715 44.172 29.5049C44.1055 29.3384 44.0067 29.1865 43.8813 29.0581C43.7559 28.9296 43.6064 28.8271 43.4413 28.7563C43.2761 28.6855 43.0986 28.6478 42.9189 28.6455V28.6455Z"/>
                <path d="M42.9189 18.7417C42.556 18.747 42.2101 18.8955 41.957 19.1549C41.7039 19.4142 41.5643 19.7631 41.5689 20.1249V22.954C41.5619 23.1351 41.5916 23.3159 41.6563 23.4853C41.721 23.6548 41.8193 23.8094 41.9454 23.94C42.0714 24.0706 42.2226 24.1746 42.3899 24.2456C42.5572 24.3165 42.7371 24.3532 42.9189 24.3532C43.1007 24.3532 43.2806 24.3165 43.4479 24.2456C43.6151 24.1746 43.7663 24.0706 43.8924 23.94C44.0184 23.8094 44.1167 23.6548 44.1814 23.4853C44.2461 23.3159 44.2759 23.1351 44.2689 22.954V20.1249C44.2737 19.763 44.1342 19.414 43.881 19.1546C43.6279 18.8952 43.2818 18.7467 42.9189 18.7417V18.7417Z"/>
                <path d="M7.08098 27.7266C6.71815 27.7318 6.37223 27.8804 6.11913 28.1397C5.86603 28.399 5.72644 28.748 5.73098 29.1098V31.9388C5.72399 32.12 5.75373 32.3008 5.81842 32.4702C5.88311 32.6396 5.98143 32.7942 6.10748 32.9249C6.23353 33.0555 6.38472 33.1594 6.55199 33.2304C6.71927 33.3014 6.89919 33.3379 7.08098 33.3379C7.26277 33.3379 7.44269 33.3014 7.60997 33.2304C7.77724 33.1594 7.92843 33.0555 8.05448 32.9249C8.18053 32.7942 8.27885 32.6396 8.34354 32.4702C8.40823 32.3008 8.43797 32.12 8.43098 31.9388V29.1098C8.43579 28.7479 8.29628 28.3988 8.04313 28.1395C7.78997 27.8801 7.4439 27.7316 7.08098 27.7266V27.7266Z"/>
                <path d="M42.9189 38.5464C42.556 38.5514 42.2099 38.6998 41.9567 38.9592C41.7036 39.2185 41.5641 39.5676 41.5689 39.9295V42.7587C41.5619 42.9398 41.5916 43.1205 41.6563 43.2899C41.721 43.4593 41.8193 43.6139 41.9454 43.7446C42.0714 43.8752 42.2226 43.9791 42.3899 44.0501C42.5572 44.1211 42.7371 44.1577 42.9189 44.1577C43.1007 44.1577 43.2806 44.1211 43.4479 44.0501C43.6151 43.9791 43.7663 43.8752 43.8924 43.7446C44.0184 43.6139 44.1167 43.4593 44.1814 43.2899C44.2461 43.1205 44.2759 42.9398 44.2689 42.7587V39.9295C44.2714 39.7503 44.2385 39.5723 44.172 39.4058C44.1055 39.2393 44.0067 39.0874 43.8813 38.9589C43.7559 38.8305 43.6064 38.728 43.4413 38.6572C43.2761 38.5864 43.0986 38.5487 42.9189 38.5464V38.5464Z"/>
                <path d="M8.43196 41.8435V39.0143C8.43895 38.8331 8.40921 38.6525 8.34452 38.4831C8.27982 38.3136 8.18151 38.159 8.05546 38.0284C7.92941 37.8978 7.77822 37.7938 7.61095 37.7228C7.44367 37.6519 7.26375 37.6152 7.08196 37.6152C6.90017 37.6152 6.72025 37.6519 6.55297 37.7228C6.38569 37.7938 6.2345 37.8978 6.10845 38.0284C5.98241 38.159 5.88409 38.3136 5.8194 38.4831C5.7547 38.6525 5.72496 38.8331 5.73196 39.0143V41.8435C5.72496 42.0246 5.7547 42.2053 5.8194 42.3747C5.88409 42.5441 5.98241 42.6987 6.10845 42.8294C6.2345 42.96 6.38569 43.0639 6.55297 43.1349C6.72025 43.2059 6.90017 43.2425 7.08196 43.2425C7.26375 43.2425 7.44367 43.2059 7.61095 43.1349C7.77822 43.0639 7.92941 42.96 8.05546 42.8294C8.18151 42.6987 8.27982 42.5441 8.34452 42.3747C8.40921 42.2053 8.43895 42.0246 8.43196 41.8435V41.8435Z"/>
                <path d="M40.1949 47.2026C40.0884 47.2222 39.9803 47.2319 39.8719 47.2316H37.6769C37.3154 47.2413 36.9719 47.3913 36.7196 47.6497C36.4673 47.9082 36.3262 48.2545 36.3262 48.6152C36.3262 48.9758 36.4673 49.3223 36.7196 49.5808C36.9719 49.8392 37.3154 49.9892 37.6769 49.9989H39.8709C40.1393 49.9992 40.4071 49.9748 40.6709 49.9261C41.0279 49.854 41.342 49.6448 41.5456 49.3436C41.7492 49.0425 41.8258 48.6736 41.7589 48.3166C41.7304 48.1406 41.6673 47.972 41.573 47.8205C41.4788 47.6691 41.3554 47.5377 41.21 47.4341C41.0645 47.3306 40.8999 47.2568 40.7257 47.2171C40.5515 47.1773 40.3711 47.1724 40.1949 47.2026V47.2026Z"/>
                <path d="M11.4459 47.2327H10.1349C9.86427 47.229 9.59849 47.1607 9.35988 47.0333C9.2015 46.9508 9.02814 46.9007 8.85006 46.8863C8.67197 46.8718 8.49278 46.893 8.32308 46.9488C8.15339 47.0046 7.99664 47.0938 7.86211 47.211C7.72759 47.3283 7.61802 47.4714 7.53988 47.6316C7.37515 47.9569 7.34366 48.3332 7.45208 48.6812C7.56049 49.0292 7.80032 49.3215 8.12088 49.4964C8.74038 49.8243 9.43053 49.9972 10.1319 50H11.4469C11.8084 49.9903 12.1519 49.8403 12.4042 49.5819C12.6565 49.3234 12.7976 48.977 12.7976 48.6163C12.7976 48.2556 12.6565 47.9093 12.4042 47.6508C12.1519 47.3924 11.8084 47.2424 11.4469 47.2327H11.4459Z"/>
                <path d="M30.7739 47.2324H28.0119C27.6503 47.2421 27.3069 47.3921 27.0546 47.6506C26.8023 47.909 26.6611 48.2554 26.6611 48.616C26.6611 48.9767 26.8023 49.3232 27.0546 49.5816C27.3069 49.84 27.6503 49.9901 28.0119 49.9997H30.7739C31.1354 49.9901 31.4789 49.84 31.7312 49.5816C31.9835 49.3232 32.1246 48.9767 32.1246 48.616C32.1246 48.2554 31.9835 47.909 31.7312 47.6506C31.4789 47.3921 31.1354 47.2421 30.7739 47.2324V47.2324Z"/>
                <path d="M21.111 47.2324H18.349C17.9875 47.2421 17.644 47.3921 17.3917 47.6506C17.1395 47.909 16.9983 48.2554 16.9983 48.616C16.9983 48.9767 17.1395 49.3232 17.3917 49.5816C17.644 49.84 17.9875 49.9901 18.349 49.9997H21.111C21.4726 49.9901 21.8161 49.84 22.0683 49.5816C22.3206 49.3232 22.4618 48.9767 22.4618 48.616C22.4618 48.2554 22.3206 47.909 22.0683 47.6506C21.8161 47.3921 21.4726 47.2421 21.111 47.2324V47.2324Z"/>
            </svg>            
            @break

        @default
            
    @endswitch
        
    {{ $slot }}
</a>