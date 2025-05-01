import React, { Suspense } from 'react';
import styled from 'styled-components/macro';
import tw from 'twin.macro';
import { HashLoader } from 'react-spinners';
import ErrorBoundary from '@/components/elements/ErrorBoundary';

export type SpinnerSize = 'small' | 'base' | 'large';

interface Props {
    size?: SpinnerSize;
    centered?: boolean;
    isBlue?: boolean;
    fullScreen?: boolean;
}

interface Spinner extends React.FC<Props> {
    Size: Record<'SMALL' | 'BASE' | 'LARGE', SpinnerSize>;
    Suspense: React.FC<Props>;
}

const LoadingText = styled.p`
    ${tw`mt-2 text-sm text-gray-500 text-center`};
`;

const CenteredContainer = styled.div<Props>`
    ${tw`flex flex-col items-center`};
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%; /* Cover the entire screen */
    background-color: rgba(0, 0, 0, 0.3); /* Semi-transparent black background */
    backdrop-filter: blur(5px); /* Apply a blur effect to the background */
    z-index: 9999;
    justify-content: center;
`;

const getSizeProps = (size?: SpinnerSize) => {
    switch (size) {
        case 'small':
            return { size: 20 }; // Adjust size as needed
        case 'large':
            return { size: 60 }; // Adjust size as needed
        default:
            return { size: 40 }; // Adjust size as needed
    }
};

const Spinner: Spinner = ({ centered, size = 'base', isBlue = false, fullScreen = false }) => {
    const { size: loaderSize } = getSizeProps(size);
    const color = isBlue ? '#27a6ec' : '#ffffff'; // Set color to #27a6ec if isBlue is true

    const loader = (
        <>
            <HashLoader color={color} size={loaderSize} />
            <LoadingText>Đang tải...</LoadingText>
        </>
    );

    return fullScreen ? (
        <CenteredContainer>{loader}</CenteredContainer>
    ) : centered ? (
        <CenteredContainer>{loader}</CenteredContainer>
    ) : (
        loader
    );
};

Spinner.displayName = 'Spinner';

Spinner.Size = {
    SMALL: 'small',
    BASE: 'base',
    LARGE: 'large',
};

Spinner.Suspense = ({ children, centered = true, size = Spinner.Size.LARGE, ...props }) => (
    <Suspense fallback={<Spinner centered={centered} size={size} {...props} />}>
        <ErrorBoundary>{children}</ErrorBoundary>
    </Suspense>
);
Spinner.Suspense.displayName = 'Spinner.Suspense';

export default Spinner;
